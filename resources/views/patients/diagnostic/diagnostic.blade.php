<style type="text/css">
    .img-fluid { max-width: 100px; height: auto; }
    #AddDiagnosticModal .modal-body { display: flex; flex-direction: column; }
</style>

<div class="row justify-content-md-center">
    <div class="col-10">
        <div class="card shadow-lg p-4 border-0">
            <div class="d-flex justify-content-between align-items-center">
                <h5>Diagnostic Lists</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddDiagnosticModal">
                    Create Diagnostic
                </button>
            </div>
            <br/>
            <div class="table-responsive">
                <table class="table table-striped" id="diagnostics-table">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="70%">Date</th>
                            <th width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="diagnostics-table-tbody">
                        <tr id="no-diagnostics-row">
                            <td colspan="3" class="text-center">No diagnostics found.</td>
                        </tr>
                        <!-- Diagnostics will be dynamically loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Create Diagnostic -->
<div class="modal fade" id="AddDiagnosticModal" tabindex="-1" aria-labelledby="DiagnosticModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="DiagnosticModalLabel">Create Diagnostic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Existing diagnostic form moved here -->
                <form id="diagnosticForm">
                    @csrf
                    <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                    <!-- Patient Details Section -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="diagnostic_date" class="form-label">Date:</label>
                            <input type="date" class="form-control" id="diagnostic_date" name="diagnostic_date" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label for="patient_name" class="form-label">Name:</label>
                            <input type="text" class="form-control" id="patient_name" name="patient_name" value="{{ $patient->first_name }} {{ $patient->last_name }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="patient_sex" class="form-label">Sex:</label>
                            <input type="text" class="form-control" id="patient_sex" name="patient_sex" value="{{ $patient->gender }}" readonly>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <label for="birthday" class="form-label">Birthday:</label>
                            <input type="date" class="form-control" id="birthday" name="birthday" value="{{ $patient->birth_date }}" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="age" class="form-label">Age:</label>
                            <input type="text" class="form-control" id="age" name="age" value="{{ \Carbon\Carbon::parse($patient->birth_date)->age }} years old" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="requesting_physician" class="form-label">Requesting Physician:</label>
                            <input type="text" class="form-control" id="requesting_physician" name="requesting_physician" value="{{ Auth::user()->name }}" readonly>
                        </div>
                    </div>
                    <!-- Hematology Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Hematology</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="hemoglobin" name="hematology[]" value="hemoglobin">
                                        <label class="form-check-label" for="hemoglobin">Hemoglobin</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="hematocrit" name="hematology[]" value="hematocrit">
                                        <label class="form-check-label" for="hematocrit">Hematocrit</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="platelet_count" name="hematology[]" value="platelet_count">
                                        <label class="form-check-label" for="platelet_count">Platelet Count</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="cbc" name="hematology[]" value="cbc">
                                        <label class="form-check-label" for="cbc">CBC</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Clinical Microscopy Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Clinical Microscopy</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="urinalysis" name="clinical_microscopy[]" value="urinalysis">
                                        <label class="form-check-label" for="urinalysis">Urinalysis</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="pregnancy_test" name="clinical_microscopy[]" value="pregnancy_test">
                                        <label class="form-check-label" for="pregnancy_test">Pregnancy Test</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="semen_analysis" name="clinical_microscopy[]" value="semen_analysis">
                                        <label class="form-check-label" for="semen_analysis">Semen Analysis</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Blood Chemistry Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Blood Chemistry</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="fbs_rbs" name="blood_chemistry[]" value="fbs_rbs">
                                        <label class="form-check-label" for="fbs_rbs">FBS/RBS (Blood Sugar)</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="lipid_profile" name="blood_chemistry[]" value="lipid_profile">
                                        <label class="form-check-label" for="lipid_profile">Lipid Profile</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="bun" name="blood_chemistry[]" value="bun">
                                        <label class="form-check-label" for="bun">BUN</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="creatinine" name="blood_chemistry[]" value="creatinine">
                                        <label class="form-check-label" for="creatinine">Creatinine</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="uric_acid" name="blood_chemistry[]" value="uric_acid">
                                        <label class="form-check-label" for="uric_acid">Uric Acid</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="sgot" name="blood_chemistry[]" value="sgot">
                                        <label class="form-check-label" for="sgot">SGOT</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="sgpt" name="blood_chemistry[]" value="sgpt">
                                        <label class="form-check-label" for="sgpt">SGPT</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="hba1c" name="blood_chemistry[]" value="hba1c">
                                        <label class="form-check-label" for="hba1c">HbA1c</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="ogtt" name="blood_chemistry[]" value="ogtt">
                                        <label class="form-check-label" for="ogtt">OGTT (Oral Glucose Tolerance Test)</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="serum_electrolytes" name="blood_chemistry[]" value="serum_electrolytes">
                                        <label class="form-check-label" for="serum_electrolytes">Serum Electrolytes</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Microbiology Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Microbiology</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="gram_stain" name="microbiology[]" value="gram_stain">
                                        <label class="form-check-label" for="gram_stain">Gram Stain</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="sputum_afb" name="microbiology[]" value="sputum_afb">
                                        <label class="form-check-label" for="sputum_afb">Sputum AFB</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="genexpert" name="microbiology[]" value="genexpert">
                                        <label class="form-check-label" for="genexpert">GeneXpert</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="koh_test" name="microbiology[]" value="koh_test">
                                        <label class="form-check-label" for="koh_test">KOH Test</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="sss" name="microbiology[]" value="sss">
                                        <label class="form-check-label" for="sss">SSS</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Immunology/Serology Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Immunology/Serology</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="hbsag" name="immunology_serology[]" value="hbsag">
                                        <label class="form-check-label" for="hbsag">HBsAg</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="hiv" name="immunology_serology[]" value="hiv">
                                        <label class="form-check-label" for="hiv">HIV</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="syphilis" name="immunology_serology[]" value="syphilis">
                                        <label class="form-check-label" for="syphilis">Syphilis</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="rpr" name="immunology_serology[]" value="rpr">
                                        <label class="form-check-label" for="rpr">RPR</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="dengue_rdt" name="immunology_serology[]" value="dengue_rdt">
                                        <label class="form-check-label" for="dengue_rdt">Dengue RDT</label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="malaria_rdt" name="immunology_serology[]" value="malaria_rdt">
                                        <label class="form-check-label" for="malaria_rdt">Malaria RDT</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Stool Tests Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Stool Tests</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="fecalysis" name="stool_tests[]" value="fecalysis">
                                        <label class="form-check-label" for="fecalysis">Fecalysis</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="fobt" name="stool_tests[]" value="fobt">
                                        <label class="form-check-label" for="fobt">Fecal Occult Blood Test (FOBT)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Blood Typing/BSMP Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Blood Typing/BSMP</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="blood_typing" name="blood_typing_bsmp[]" value="blood_typing">
                                        <label class="form-check-label" for="blood_typing">Blood Typing</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="checkbox" id="bsmp" name="blood_typing_bsmp[]" value="bsmp">
                                        <label class="form-check-label" for="bsmp">BSMP (Barangay Systematic Medical Profiling)</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Others Section -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0">Others</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="others" class="form-label">Other Tests:</label>
                                    <textarea class="form-control" id="others" name="others" rows="3" placeholder="Enter other diagnostic tests or notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save Diagnostic Information</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Auto-calculate age when birthday changes
    $('#birthday').on('change', function() {
        const birthday = new Date($(this).val());
        const today = new Date();
        let age = today.getFullYear() - birthday.getFullYear();
        const monthDiff = today.getMonth() - birthday.getMonth();
        if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthday.getDate())) {
            age--;
        }
        $('#age').val(age + ' years old');
    });

    // Load diagnostics for this patient
    function loadDiagnostics() {
        const patientId = $('input[name="patient_id"]').val();
        $.ajax({
            url: `/patients/${patientId}/diagnostics`,
            method: 'GET',
            success: function(response) {
                const tbody = $('#diagnostics-table-tbody');
                tbody.empty();
                if (!response.diagnostics || response.diagnostics.length === 0) {
                    tbody.append('<tr id="no-diagnostics-row"><td colspan="3" class="text-center">No diagnostics found.</td></tr>');
                } else {
                    response.diagnostics.forEach(function(diagnostic) {
                        tbody.append(`
                            <tr>
                                <td>${diagnostic.id}</td>
                                <td>${diagnostic.diagnostic_date}</td>
                                <td>
                                    <button class="btn btn-info btn-sm view-btn" data-id="${diagnostic.id}">View</button>
                                    <a href="/diagnostic/${diagnostic.id}/print" class="btn btn-secondary btn-sm" target="_blank">Print</a>
                                </td>
                            </tr>
                        `);
                    });
                }
            },
            error: function() {
                $('#diagnostics-table-tbody').html('<tr><td colspan="3" class="text-center text-danger">Failed to load diagnostics.</td></tr>');
            }
        });
    }

    loadDiagnostics();

    // Form submission
    $('#diagnosticForm').on('submit', function(e) {
        e.preventDefault();
        // Convert arrays to JSON for backend
        const form = $(this)[0];
        const formData = new FormData(form);
        // Convert array fields to JSON
        ['hematology','clinical_microscopy','blood_chemistry','microbiology','immunology_serology','stool_tests','blood_typing_bsmp'].forEach(function(field) {
            const values = formData.getAll(field + '[]');
            formData.delete(field + '[]');
            if (values.length > 0) {
                formData.append(field, JSON.stringify(values));
            }
        });
        // Convert FormData to object for AJAX
        const data = {};
        formData.forEach((value, key) => {
            // If value is a JSON string, parse it
            try { data[key] = JSON.parse(value); } catch { data[key] = value; }
        });
        $.ajax({
            url: "{{ route('diagnostics.store') }}",
            method: "POST",
            data: data,
            success: function(response) {
                alert('Diagnostic information saved successfully!');
                $('#AddDiagnosticModal').modal('hide');
                loadDiagnostics();
            },
            error: function(xhr) {
                alert('Error saving diagnostic information: ' + xhr.responseText);
            }
        });
    });
});
</script> 