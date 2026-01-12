<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulk Approve Surat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Bulk Approve Surat</h4>
                        <a href="{% url 'nama_url_list_surat' %}" class="btn btn-secondary">Kembali</a>
                    </div>
                    <div class="card-body">
                        {% if messages %}
                            {% for message in messages %}
                                <div class="alert alert-{{ message.tags }} alert-dismissible fade show" role="alert">
                                    {{ message }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                </div>
                            {% endfor %}
                        {% endif %}

                        <form method="post" id="bulkApproveForm">
                            {% csrf_token %}
                            
                            {% if surat_list %}
                                <div class="mb-3">
                                    <button type="button" class="btn btn-outline-primary btn-sm" id="selectAllBtn">
                                        Pilih Semua
                                    </button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" id="deselectAllBtn">
                                        Batal Pilih
                                    </button>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th width="50px">Pilih</th>
                                                <th>No. Surat</th>
                                                <th>Perihal</th>
                                                <th>Pengirim</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            {% for surat in surat_list %}
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="selected_surat" value="{{ surat.id }}" class="form-check-input surat-checkbox">
                                                </td>
                                                <td>{{ surat.nomor_surat }}</td>
                                                <td>{{ surat.perihal }}</td>
                                                <td>{{ surat.pengirim }}</td>
                                                <td>{{ surat.tanggal|date:"d/m/Y" }}</td>
                                                <td>
                                                    <span class="badge bg-warning">{{ surat.get_status_display }}</span>
                                                </td>
                                            </tr>
                                            {% endfor %}
                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success" id="approveBtn" disabled>
                                        <i class="fas fa-check"></i> Approve Surat Terpilih
                                    </button>
                                    <span id="selectedCount" class="ms-2 text-muted">0 surat dipilih</span>
                                </div>
                            {% else %}
                                <div class="alert alert-info">
                                    Tidak ada surat yang memerlukan approval.
                                </div>
                            {% endif %}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Select All functionality
        document.getElementById('selectAllBtn').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.surat-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
            updateSelectedCount();
        });

        document.getElementById('deselectAllBtn').addEventListener('click', function() {
            const checkboxes = document.querySelectorAll('.surat-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
            updateSelectedCount();
        });

        // Update selected count and button state
        function updateSelectedCount() {
            const checkboxes = document.querySelectorAll('.surat-checkbox');
            const selectedCount = document.querySelectorAll('.surat-checkbox:checked').length;
            const selectedCountElement = document.getElementById('selectedCount');
            const approveBtn = document.getElementById('approveBtn');

            selectedCountElement.textContent = `${selectedCount} surat dipilih`;
            
            if (selectedCount > 0) {
                approveBtn.disabled = false;
            } else {
                approveBtn.disabled = true;
            }
        }

        // Add event listeners to all checkboxes
        document.querySelectorAll('.surat-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', updateSelectedCount);
        });

        // Confirm before submitting
        document.getElementById('bulkApproveForm').addEventListener('submit', function(e) {
            const selectedCount = document.querySelectorAll('.surat-checkbox:checked').length;
            if (selectedCount > 0) {
                if (!confirm(`Apakah Anda yakin ingin menyetujui ${selectedCount} surat?`)) {
                    e.preventDefault();
                }
            } else {
                e.preventDefault();
                alert('Pilih setidaknya satu surat untuk di-approve.');
            }
        });

        // Initialize count on page load
        updateSelectedCount();
    </script>
</body>
</html>