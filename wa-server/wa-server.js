const { Client, LocalAuth } = require('whatsapp-web.js');
const qrcode = require('qrcode');
const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http, {
    cors: {
        origin: "*",
        methods: ["GET", "POST"]
    }
});

console.log('🚀 Starting WhatsApp Server...');

// Global variables
let client = null;
let qrCodeData = null;
let isClientReady = false;
let connectionStatus = 'initializing';
let clientInitialized = false;

// Initialize WhatsApp Client
function initializeClient() {
    if (clientInitialized) {
        console.log('⚠️ Client already initialized');
        return;
    }

    console.log('🔧 Initializing WhatsApp Client...');
    clientInitialized = true;
    connectionStatus = 'initializing';

    client = new Client({
        authStrategy: new LocalAuth({
            dataPath: './wa-session'
        }),
        puppeteer: {
            headless: true,
            args: [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--disable-dev-shm-usage',
                '--disable-accelerated-2d-canvas',
                '--no-first-run',
                '--no-zygote',
                '--disable-gpu',
                '--disable-web-security',
                '--disable-features=IsolateOrigins,site-per-process'
            ],
            executablePath: null
        }
    });

    // Generate QR Code
    client.on('qr', async (qr) => {
        console.log('\n📱 ========== QR CODE GENERATED ==========');
        console.log('QR String Length:', qr.length);
        connectionStatus = 'qr_ready';
        
        try {
            qrCodeData = await qrcode.toDataURL(qr, {
                errorCorrectionLevel: 'H',
                margin: 4,
                width: 300
            });
            
            console.log('✅ QR Code Data URL generated');
            console.log('Data URL Length:', qrCodeData.length);
            console.log('Data URL Preview:', qrCodeData.substring(0, 50) + '...');
            
            console.log('📡 Broadcasting QR to', io.sockets.sockets.size, 'connected clients');
            io.emit('qr', qrCodeData);
            io.emit('status', { 
                status: 'qr_ready', 
                message: 'QR Code siap! Scan dengan WhatsApp Anda' 
            });
            
            console.log('✅ QR Code broadcasted successfully');
            console.log('=========================================\n');
            
        } catch (err) {
            console.error('❌ Error generating QR:', err);
            io.emit('status', { 
                status: 'error', 
                message: 'Gagal generate QR Code: ' + err.message 
            });
        }
    });

    // Client ready
    client.on('ready', () => {
        console.log('\n✅ ========== WHATSAPP CLIENT READY ==========');
        isClientReady = true;
        connectionStatus = 'connected';
        qrCodeData = null;
        
        io.emit('status', { 
            status: 'connected', 
            message: 'WhatsApp berhasil terhubung!' 
        });
        io.emit('ready');
        
        console.log('Client Info:', client.info);
        console.log('=============================================\n');
    });

    // Authentication
    client.on('authenticated', () => {
        console.log('🔐 WhatsApp berhasil ter-autentikasi');
        connectionStatus = 'authenticated';
        io.emit('status', { 
            status: 'authenticated', 
            message: 'Autentikasi berhasil, menunggu koneksi...' 
        });
    });

    // Auth failure
    client.on('auth_failure', (msg) => {
        console.error('\n❌ ========== AUTH FAILURE ==========');
        console.error('Reason:', msg);
        console.error('=====================================\n');
        
        connectionStatus = 'auth_failed';
        isClientReady = false;
        
        io.emit('status', { 
            status: 'auth_failed', 
            message: 'Autentikasi gagal: ' + msg 
        });
    });

    // Disconnection
    client.on('disconnected', (reason) => {
        console.log('\n⚠️ ========== DISCONNECTED ==========');
        console.log('Reason:', reason);
        console.log('====================================\n');
        
        isClientReady = false;
        connectionStatus = 'disconnected';
        qrCodeData = null;
        
        io.emit('status', { 
            status: 'disconnected', 
            message: 'WhatsApp terputus: ' + reason 
        });
    });

    // Loading screen
    client.on('loading_screen', (percent, message) => {
        console.log(`📥 Loading: ${percent}% - ${message || ''}`);
        connectionStatus = 'loading';
        
        io.emit('loading', { 
            percent: percent,
            message: message 
        });
    });

    // Change state
    client.on('change_state', state => {
        console.log('🔄 State changed:', state);
    });

    // Initialize client
    console.log('🚀 Starting WhatsApp client initialization...');
    client.initialize().catch(err => {
        console.error('❌ Failed to initialize client:', err);
        connectionStatus = 'error';
        clientInitialized = false;
        
        io.emit('status', { 
            status: 'error', 
            message: 'Gagal menginisialisasi client: ' + err.message 
        });
    });
}

// Express middleware
app.use(express.json());
app.use(express.urlencoded({ extended: true }));

// CORS
app.use((req, res, next) => {
    res.header('Access-Control-Allow-Origin', '*');
    res.header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
    res.header('Access-Control-Allow-Headers', 'Content-Type');
    next();
});

// Serve static HTML for web interface
app.get('/', (req, res) => {
    res.send(`
<!DOCTYPE html>
<html>
<head>
    <title>WhatsApp Server Control Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.socket.io/4.5.4/socket.io.min.js"></script>
    <style>
        body { background: #f8f9fa; padding: 20px; }
        .status-badge { font-size: 18px; padding: 10px 20px; }
        .qr-container { text-align: center; padding: 30px; background: white; border-radius: 10px; margin: 20px 0; }
        .qr-container img { max-width: 300px; border: 2px solid #ddd; padding: 10px; }
        .log-container { background: #1e1e1e; color: #00ff00; padding: 20px; border-radius: 5px; max-height: 400px; overflow-y: auto; font-family: monospace; font-size: 13px; }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4"><i class="fab fa-whatsapp text-success"></i> WhatsApp Server Control Panel</h1>
        
        <!-- Status Card -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Server Status</h5>
                <p id="server-status" class="status-badge badge bg-secondary">Checking...</p>
                <p id="wa-status" class="status-badge badge bg-secondary">Not Connected</p>
            </div>
        </div>
        
        <!-- QR Code Section -->
        <div id="qr-section" class="qr-container" style="display: none;">
            <h4 class="mb-3"><i class="fas fa-qrcode"></i> Scan QR Code</h4>
            <img id="qr-code" src="" alt="QR Code">
            <p class="mt-3 text-muted">
                <i class="fas fa-mobile-alt"></i> Buka WhatsApp di HP → Settings → Linked Devices → Link a Device
            </p>
        </div>
        
        <!-- Logs -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Server Logs</h5>
                <div id="logs" class="log-container">Waiting for connection...</div>
                <button class="btn btn-sm btn-secondary mt-2" onclick="clearLogs()">Clear Logs</button>
            </div>
        </div>
    </div>
    
    <script>
        console.log('🌐 Connecting to Socket.IO...');
        const socket = io();
        
        socket.on('connect', () => {
            console.log('✅ Connected to server');
            document.getElementById('server-status').className = 'status-badge badge bg-success';
            document.getElementById('server-status').textContent = '🟢 Server Online';
            addLog('✅ Connected to server');
        });
        
        socket.on('disconnect', () => {
            console.log('❌ Disconnected from server');
            document.getElementById('server-status').className = 'status-badge badge bg-danger';
            document.getElementById('server-status').textContent = '🔴 Server Offline';
            addLog('❌ Disconnected from server');
        });
        
        socket.on('qr', (qrData) => {
            console.log('📱 QR Code received!');
            console.log('QR Data length:', qrData.length);
            console.log('QR Data preview:', qrData.substring(0, 50) + '...');
            
            document.getElementById('qr-section').style.display = 'block';
            document.getElementById('qr-code').src = qrData;
            addLog('📱 QR Code generated - Please scan with WhatsApp');
        });
        
        socket.on('ready', () => {
            console.log('✅ WhatsApp ready!');
            document.getElementById('qr-section').style.display = 'none';
            document.getElementById('wa-status').className = 'status-badge badge bg-success';
            document.getElementById('wa-status').textContent = '✅ WhatsApp Connected';
            addLog('✅ WhatsApp client ready!');
        });
        
        socket.on('status', (data) => {
            console.log('📊 Status update:', data);
            addLog('📊 Status: ' + data.message);
            
            if (data.status === 'connected') {
                document.getElementById('wa-status').className = 'status-badge badge bg-success';
                document.getElementById('wa-status').textContent = '✅ WhatsApp Connected';
                document.getElementById('qr-section').style.display = 'none';
            } else if (data.status === 'disconnected') {
                document.getElementById('wa-status').className = 'status-badge badge bg-danger';
                document.getElementById('wa-status').textContent = '❌ Disconnected';
            } else if (data.status === 'qr_ready') {
                document.getElementById('wa-status').className = 'status-badge badge bg-warning';
                document.getElementById('wa-status').textContent = '📱 Scan QR Code';
            } else if (data.status === 'loading') {
                document.getElementById('wa-status').className = 'status-badge badge bg-info';
                document.getElementById('wa-status').textContent = '⏳ Loading...';
            }
        });
        
        socket.on('loading', (data) => {
            console.log('📥 Loading:', data.percent + '%');
            addLog('📥 Loading: ' + data.percent + '%' + (data.message ? ' - ' + data.message : ''));
        });
        
        function addLog(message) {
            const logs = document.getElementById('logs');
            const timestamp = new Date().toLocaleTimeString();
            logs.innerHTML += '[' + timestamp + '] ' + message + '\\n';
            logs.scrollTop = logs.scrollHeight;
        }
        
        function clearLogs() {
            document.getElementById('logs').innerHTML = '';
            addLog('Logs cleared');
        }
    </script>
</body>
</html>
    `);
});

// API: Get current status
app.get('/status', (req, res) => {
    res.json({
        server: 'running',
        whatsapp: connectionStatus,
        ready: isClientReady,
        qrAvailable: qrCodeData !== null,
        clientInitialized: clientInitialized,
        timestamp: new Date().toISOString()
    });
});

// API: Get QR Code
app.get('/qr', (req, res) => {
    if (qrCodeData) {
        res.json({ 
            success: true, 
            qr: qrCodeData,
            status: connectionStatus
        });
    } else {
        res.json({ 
            success: false, 
            message: 'QR not available',
            status: connectionStatus,
            ready: isClientReady
        });
    }
});

// API: Send message
app.post('/send-message', async (req, res) => {
    try {
        if (!isClientReady) {
            return res.status(503).json({
                success: false,
                error: 'WhatsApp client not ready. Status: ' + connectionStatus
            });
        }
        
        const { nomor, pesan } = req.body;
        
        if (!nomor || !pesan) {
            return res.status(400).json({
                success: false,
                error: 'Nomor dan pesan harus diisi'
            });
        }
        
        const cleanNumber = nomor.replace(/\D/g, '');
        const chatId = cleanNumber.includes('@c.us') ? cleanNumber : cleanNumber + '@c.us';
        
        console.log(`📤 Mengirim pesan ke: ${chatId}`);
        
        await client.sendMessage(chatId, pesan);
        
        console.log('✅ Pesan berhasil dikirim');
        
        res.json({
            success: true,
            message: 'Pesan berhasil dikirim',
            to: cleanNumber,
            timestamp: new Date().toISOString()
        });
        
    } catch (error) {
        console.error('❌ Error mengirim pesan:', error);
        res.status(500).json({
            success: false,
            error: error.message
        });
    }
});

// ✅ API BARU: Logout WhatsApp
app.post('/logout', async (req, res) => {
    try {
        console.log('🚪 Logging out WhatsApp...');
        
        if (!client || !isClientReady) {
            return res.json({ 
                success: false, 
                message: 'WhatsApp tidak terhubung' 
            });
        }
        
        // Logout dari WhatsApp
        await client.logout();
        
        console.log('✅ WhatsApp logged out successfully');
        
        // Reset status
        isClientReady = false;
        connectionStatus = 'disconnected';
        qrCodeData = null;
        clientInitialized = false;
        
        // Broadcast status
        io.emit('status', { 
            status: 'disconnected', 
            message: 'WhatsApp berhasil logout, menunggu reinitialize...' 
        });
        
        // ✅ Destroy client dan reinitialize untuk generate QR baru
        setTimeout(async () => {
            try {
                console.log('🔄 Destroying old client...');
                await client.destroy();
                client = null;
                
                console.log('🔄 Reinitializing client untuk QR baru...');
                
                // Wait a bit before reinitialize
                setTimeout(() => {
                    initializeClient();
                    
                    io.emit('status', { 
                        status: 'reinitializing', 
                        message: 'Menginisialisasi ulang, QR akan muncul sebentar lagi...' 
                    });
                }, 2000);
                
            } catch (err) {
                console.error('❌ Error destroying client:', err);
            }
        }, 1000);
        
        res.json({ 
            success: true, 
            message: 'WhatsApp berhasil logout, QR akan muncul sebentar lagi' 
        });
        
    } catch (error) {
        console.error('❌ Error logout:', error);
        res.status(500).json({ 
            success: false, 
            error: error.message 
        });
    }
});

// API: Restart client
app.post('/restart', async (req, res) => {
    try {
        console.log('🔄 Restarting WhatsApp client...');
        
        if (client) {
            await client.destroy();
            clientInitialized = false;
            isClientReady = false;
            connectionStatus = 'restarting';
        }
        
        setTimeout(() => {
            initializeClient();
        }, 2000);
        
        res.json({ success: true, message: 'Client restarting...' });
    } catch (error) {
        console.error('❌ Error restarting:', error);
        res.status(500).json({ success: false, error: error.message });
    }
});

// Socket.io connection
io.on('connection', (socket) => {
    console.log('👤 Client connected:', socket.id);
    console.log('Total clients:', io.sockets.sockets.size);
    
    socket.emit('status', { 
        status: connectionStatus, 
        message: getStatusMessage(connectionStatus)
    });
    
    if (qrCodeData) {
        console.log('📤 Sending existing QR to new client');
        socket.emit('qr', qrCodeData);
    }
    
    if (isClientReady) {
        socket.emit('ready');
    }
    
    socket.on('disconnect', () => {
        console.log('👤 Client disconnected:', socket.id);
        console.log('Remaining clients:', io.sockets.sockets.size);
    });
});

// Helper function to get status message
function getStatusMessage(status) {
    const messages = {
        'initializing': 'Menginisialisasi WhatsApp client...',
        'qr_ready': 'QR Code siap! Scan dengan WhatsApp Anda',
        'authenticated': 'Autentikasi berhasil',
        'loading': 'Loading WhatsApp...',
        'connected': 'WhatsApp terhubung!',
        'disconnected': 'WhatsApp terputus',
        'auth_failed': 'Autentikasi gagal',
        'error': 'Terjadi error',
        'restarting': 'Restarting client...',
        'reinitializing': 'Menginisialisasi ulang untuk QR baru...'
    };
    return messages[status] || 'Status tidak diketahui';
}

// Start server
const PORT = process.env.PORT || 3000;

console.log('🎬 Starting initialization...');
initializeClient();

http.listen(PORT, () => {
    console.log(`\n🌐 ========== SERVER STARTED ==========`);
    console.log(`📡 Port: ${PORT}`);
    console.log(`🌍 Web Interface: http://localhost:${PORT}`);
    console.log(`📡 API Endpoint: http://localhost:${PORT}/send-message`);
    console.log(`📊 Status API: http://localhost:${PORT}/status`);
    console.log(`🚪 Logout API: http://localhost:${PORT}/logout`);
    console.log(`=====================================\n`);
});

// Handle process termination
process.on('SIGINT', async () => {
    console.log('\n⚠️ Shutting down gracefully...');
    if (client) {
        await client.destroy();
    }
    process.exit(0);
});

process.on('uncaughtException', (err) => {
    console.error('❌ Uncaught Exception:', err);
});

process.on('unhandledRejection', (err) => {
    console.error('❌ Unhandled Rejection:', err);
}); 