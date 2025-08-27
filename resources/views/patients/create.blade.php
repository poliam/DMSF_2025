<x-app-layout>
    <div class="container py-4">
        <!-- Form Container with Border and Shadow -->
        <div class="card shadow-lg p-4 border rounded-lg">
            <form action="{{ route('patients.store') }}" method="POST" id="patient-form">
                @csrf
                <!-- Add a submission token to prevent duplicates -->
                <input type="hidden" name="submission_token" value="{{ uniqid('form_', true) }}">
                <legend>Patient Identifying Record</legend>
                <hr>
                <!-- First Row: Personal Information -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="last_name">Last Name*</label>
                            <input type="text" class="form-control rounded-lg @error('last_name') is-invalid @enderror" name="last_name" id="last_name" value="{{ old('last_name') }}" required pattern="[A-Za-z\s\-\.']+" title="Only letters, spaces, hyphens, dots, and apostrophes are allowed">
                            @error('last_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="last_name_error" style="display: none;">
                                Please enter a valid last name (letters only).
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="first_name">First Name*</label>
                            <input type="text" class="form-control rounded-lg @error('first_name') is-invalid @enderror" name="first_name" id="first_name" value="{{ old('first_name') }}" required pattern="[A-Za-z\s\-\.']+" title="Only letters, spaces, hyphens, dots, and apostrophes are allowed">
                            @error('first_name')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="first_name_error" style="display: none;">
                                Please enter a valid first name (letters only).
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="middle_name">Middle Name</label>
                            <input type="text" class="form-control rounded-lg" name="middle_name" id="middle_name" value="{{ old('middle_name') }}">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="birth_date">Birthdate*</label>
                            <input type="date" class="form-control rounded-lg @error('birth_date') is-invalid @enderror" name="birth_date" id="birth_date" value="{{ old('birth_date') }}" required>
                            @error('birth_date')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="birth_date_error" style="display: none;">
                                Please select a birthdate.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="text" class="form-control rounded-lg" id="age" readonly>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Sex*</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            @error('gender')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="gender_error" style="display: none;">
                                Please select your sex.
                            </div>
                        </div>
                    </div>
                </div>

                <legend>Address</legend>
                <hr>
                <!-- Second Row: Address Information -->
                <div class="row mb-4 mt-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="street">Street Address*</label>
                            <input type="text" class="form-control rounded-lg @error('street') is-invalid @enderror" name="street" id="street" value="{{ old('street') }}" required>
                            @error('street')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="street_error" style="display: none;">
                                Please enter a street address.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="brgy_address">Brgy Address*</label>
                            <select class="form-control @error('brgy_address') is-invalid @enderror" name="brgy_address" id="brgy_address" required>
                                <option value="">Select Barangay</option>
                                <option value="Sitio Balite, Brgy Marilog, Davao City" {{ old('brgy_address') == 'Sitio Balite, Brgy Marilog, Davao City' ? 'selected' : '' }}>Sitio Balite, Brgy Marilog, Davao City</option>
                                <option value="Brgy Cogon, Babak District, IGACOS" {{ old('brgy_address') == 'Brgy Cogon, Babak District, IGACOS' ? 'selected' : '' }}>Brgy Cogon, Babak District, IGACOS</option>
                                <option value="other" {{ old('brgy_address') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('brgy_address')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="brgy_address_error" style="display: none;">
                                Please select a barangay.
                            </div>
                            <input type="text" class="form-control mt-2" name="brgy_address_other" id="brgy_address_other" placeholder="If Other, specify" style="display:none;">
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="address_landmark">Address Landmark</label>
                            <input type="text" class="form-control rounded-lg @error('address_landmark') is-invalid @enderror" name="address_landmark" id="address_landmark" value="{{ old('address_landmark') }}">
                            @error('address_landmark')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="occupation">Occupation</label>
                            <input type="text" class="form-control rounded-lg @error('occupation') is-invalid @enderror" name="occupation" id="occupation" value="{{ old('occupation') }}">
                            @error('occupation')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <legend>Other Information</legend>
                <hr>
                <!-- Fifth Row: Additional Info -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="highest_educational_attainment">Highest Educational Attainment*</label>
                            <select class="form-control @error('highest_educational_attainment') is-invalid @enderror" name="highest_educational_attainment" id="highest_educational_attainment" required>
                                <option value="">Select</option>
                                <option value="No formal education" {{ old('highest_educational_attainment') == 'No formal education' ? 'selected' : '' }}>No formal education</option>
                                <option value="Elementary level" {{ old('highest_educational_attainment') == 'Elementary level' ? 'selected' : '' }}>Elementary level</option>
                                <option value="Elementary graduate" {{ old('highest_educational_attainment') == 'Elementary graduate' ? 'selected' : '' }}>Elementary graduate</option>
                                <option value="Junior HS level" {{ old('highest_educational_attainment') == 'Junior HS level' ? 'selected' : '' }}>Junior HS level</option>
                                <option value="Junior HS graduate" {{ old('highest_educational_attainment') == 'Junior HS graduate' ? 'selected' : '' }}>Junior HS graduate</option>
                                <option value="Senior HS level" {{ old('highest_educational_attainment') == 'Senior HS level' ? 'selected' : '' }}>Senior HS level</option>
                                <option value="Senior HS graduate" {{ old('highest_educational_attainment') == 'Senior HS graduate' ? 'selected' : '' }}>Senior HS graduate</option>
                                <option value="Vocational course" {{ old('highest_educational_attainment') == 'Vocational course' ? 'selected' : '' }}>Vocational course</option>
                                <option value="College level" {{ old('highest_educational_attainment') == 'College level' ? 'selected' : '' }}>College level</option>
                                <option value="College graduate" {{ old('highest_educational_attainment') == 'College graduate' ? 'selected' : '' }}>College graduate</option>
                                <option value="Doctoral level" {{ old('highest_educational_attainment') == 'Doctoral level' ? 'selected' : '' }}>Doctoral level</option>
                                <option value="Postdoctoral level" {{ old('highest_educational_attainment') == 'Postdoctoral level' ? 'selected' : '' }}>Postdoctoral level</option>
                                <option value="Postdoctoral graduate" {{ old('highest_educational_attainment') == 'Postdoctoral graduate' ? 'selected' : '' }}>Postdoctoral graduate</option>
                            </select>
                            @error('highest_educational_attainment')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="highest_educational_attainment_error" style="display: none;">
                                Please select your highest educational attainment.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marital_status">Marital Status*</label>
                            <select class="form-control @error('marital_status') is-invalid @enderror" name="marital_status" id="marital_status" required>
                                <option value="">Select</option>
                                <option value="Married" {{ old('marital_status') == 'Married' ? 'selected' : '' }}>Married</option>
                                <option value="Live-in" {{ old('marital_status') == 'Live-in' ? 'selected' : '' }}>Live-in</option>
                                <option value="Separated" {{ old('marital_status') == 'Separated' ? 'selected' : '' }}>Separated</option>
                                <option value="Single" {{ old('marital_status') == 'Single' ? 'selected' : '' }}>Single</option>
                            </select>
                            @error('marital_status')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="marital_status_error" style="display: none;">
                                Please select your marital status.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="monthly_household_income">Monthly Household Income (Php)*</label>
                            <select class="form-control @error('monthly_household_income') is-invalid @enderror" name="monthly_household_income" id="monthly_household_income" required>
                                <option value="">Select</option>
                                <option value="<10,000" {{ old('monthly_household_income') == '<10,000' ? 'selected' : '' }}>&lt;10,000</option>
                                <option value="10,000-20,000" {{ old('monthly_household_income') == '10,000-20,000' ? 'selected' : '' }}>10,000-20,000</option>
                                <option value="20,000-40,000" {{ old('monthly_household_income') == '20,000-40,000' ? 'selected' : '' }}>20,000-40,000</option>
                                <option value="40,000-70,000" {{ old('monthly_household_income') == '40,000-70,000' ? 'selected' : '' }}>40,000-70,000</option>
                                <option value="70,000-100,000" {{ old('monthly_household_income') == '70,000-100,000' ? 'selected' : '' }}>70,000-100,000</option>
                                <option value=">100,000" {{ old('monthly_household_income') == '>100,000' ? 'selected' : '' }}>>&nbsp;100,000</option>
                            </select>
                            @error('monthly_household_income')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="monthly_household_income_error" style="display: none;">
                                Please select your monthly household income.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="religion">Religion*</label>
                            <select class="form-control @error('religion') is-invalid @enderror" name="religion" id="religion" required>
                                <option value="">Select</option>
                                <option value="Christian" {{ old('religion') == 'Christian' ? 'selected' : '' }}>Christian</option>
                                <option value="Muslim" {{ old('religion') == 'Muslim' ? 'selected' : '' }}>Muslim</option>
                                <option value="Other" {{ old('religion') == 'Other' ? 'selected' : '' }}>Other</option>
                                <option value="None" {{ old('religion') == 'None' ? 'selected' : '' }}>None</option>
                            </select>
                            @error('religion')
                                <span class="text-danger text-sm">{{ $message }}</span>
                            @enderror
                            <div class="invalid-feedback" id="religion_error" style="display: none;">
                                Please select your religion.
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Image Preview Section -->
                <div class="row mb-4" id="image-preview-section" style="display: none;">
                    <div class="col-12">
                        <div class="text-center">
                            <h6>Patient Photo</h6>
                            <div class="position-relative d-inline-block">
                                <img id="form-image-preview" class="img-fluid rounded" style="max-width: 200px; height: auto; border: 3px solid #7CAD3E;">
                                <button type="button" id="remove-image-btn" class="btn btn-danger btn-sm position-absolute" style="top: -10px; right: -10px; border-radius: 50%; width: 30px; height: 30px; padding: 0;">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" id="submit-btn" class="btn btn-success btn-no-double-click mt-4 me-2">
                        <span id="submit-text">Create Patient</span>
                        <span id="submit-spinner" class="spinner-border spinner-border-sm ms-2" style="display: none;" role="status" aria-hidden="true"></span>
                    </button>
                    <button type="button" id="capture-image-btn" class="btn btn-info btn-no-double-click mt-4 me-2">
                        <i class="fas fa-camera me-2"></i>Capture Photo
                    </button>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary mt-4">Cancel</a>
                </div>
                
                <!-- Hidden input for image data -->
                <input type="hidden" name="image_path" id="image_path" value="">
            </form>
        </div>
    </div>
    
    <!-- Camera Modal -->
    <div class="modal fade" id="cameraModal" tabindex="-1" aria-labelledby="cameraModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cameraModalLabel">Capture Patient Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-3">
                        <div id="camera-container" class="mb-3">
                            <video id="camera" autoplay playsinline class="img-fluid rounded" style="max-width: 100%; height: auto;"></video>
                        </div>
                        <div id="captured-image-container" class="mb-3" style="display: none;">
                            <img id="captured-image" class="img-fluid rounded" style="max-width: 100%; height: auto;">
                        </div>
                        <div class="btn-group" role="group">
                            <button type="button" id="start-camera-btn" class="btn btn-primary">
                                <i class="fas fa-play me-2"></i>Start Camera
                            </button>
                            <button type="button" id="capture-btn" class="btn btn-success" style="display: none;">
                                <i class="fas fa-camera me-2"></i>Take Photo
                            </button>
                            <button type="button" id="retake-btn" class="btn btn-warning" style="display: none;">
                                <i class="fas fa-redo me-2"></i>Retake
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="save-image-btn" class="btn btn-success" style="display: none;">Save Photo</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Show/hide other barangay field
        document.getElementById('brgy_address').addEventListener('change', function() {
            document.getElementById('brgy_address_other').style.display = this.value === 'other' ? 'block' : 'none';
        });

        // Auto-calculate age from birthdate
        function calculateAge() {
            const birthDateField = document.getElementById('birth_date');
            const ageField = document.getElementById('age');
            
            if (birthDateField.value) {
                const birthDate = new Date(birthDateField.value);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                ageField.value = isNaN(age) ? '' : age;
            } else {
                ageField.value = '';
            }
        }

        // Real-time validation for name fields
        function validateNameField(fieldId) {
            const field = document.getElementById(fieldId);
            const value = field.value.trim();
            const namePattern = /^[A-Za-z\s\-\.']+$/;
            const errorDiv = document.getElementById(fieldId + '_error');
            
            // Remove existing validation classes
            field.classList.remove('is-invalid', 'is-valid');
            
            if (value === '') {
                // Empty field
                field.classList.add('is-invalid');
                errorDiv.textContent = 'This field is required.';
                errorDiv.style.display = 'block';
                return false;
            } else if (!namePattern.test(value)) {
                // Invalid characters
                field.classList.add('is-invalid');
                errorDiv.textContent = 'Only letters, spaces, hyphens, dots, and apostrophes are allowed.';
                errorDiv.style.display = 'block';
                return false;
            } else {
                // Valid
                field.classList.add('is-valid');
                errorDiv.style.display = 'none';
                return true;
            }
        }

        // Validation for birth date field (includes age calculation)
        function validateBirthDate() {
            const field = document.getElementById('birth_date');
            const value = field.value;
            const errorDiv = document.getElementById('birth_date_error');
            
            // Remove existing validation classes
            field.classList.remove('is-invalid', 'is-valid');
            
            if (value === '') {
                // Empty field
                field.classList.add('is-invalid');
                errorDiv.textContent = 'Please select a birthdate.';
                errorDiv.style.display = 'block';
                document.getElementById('age').value = '';
                return false;
            } else {
                // Check if date is valid and not in the future
                const selectedDate = new Date(value);
                const today = new Date();
                today.setHours(0, 0, 0, 0); // Reset time to compare dates only
                
                if (selectedDate > today) {
                    field.classList.add('is-invalid');
                    errorDiv.textContent = 'Birthdate cannot be in the future.';
                    errorDiv.style.display = 'block';
                    document.getElementById('age').value = '';
                    return false;
                } else {
                    // Valid - calculate age
                    field.classList.add('is-valid');
                    errorDiv.style.display = 'none';
                    calculateAge();
                    return true;
                }
            }
        }

        // Validation for select fields
        function validateSelectField(fieldId) {
            const field = document.getElementById(fieldId);
            const value = field.value;
            const errorDiv = document.getElementById(fieldId + '_error');
            
            // Remove existing validation classes
            field.classList.remove('is-invalid', 'is-valid');
            
            if (value === '' || value === null) {
                // Empty field
                field.classList.add('is-invalid');
                errorDiv.style.display = 'block';
                return false;
            } else {
                // Valid
                field.classList.add('is-valid');
                errorDiv.style.display = 'none';
                return true;
            }
        }

        // Validation for text input fields
        function validateTextInputField(fieldId) {
            const field = document.getElementById(fieldId);
            const value = field.value.trim();
            const errorDiv = document.getElementById(fieldId + '_error');
            
            // Remove existing validation classes
            field.classList.remove('is-invalid', 'is-valid');
            
            if (value === '') {
                // Empty field
                field.classList.add('is-invalid');
                errorDiv.style.display = 'block';
                return false;
            } else {
                // Valid
                field.classList.add('is-valid');
                errorDiv.style.display = 'none';
                return true;
            }
        }

        // Validation for radio button groups
        function validateRadioField(fieldName) {
            const radios = document.querySelectorAll(`input[name="${fieldName}"]`);
            const errorDiv = document.getElementById(fieldName + '_error');
            let isChecked = false;
            
            // Check if any radio is selected
            radios.forEach(radio => {
                if (radio.checked) {
                    isChecked = true;
                }
            });
            
            // Remove existing validation classes from all radios
            radios.forEach(radio => {
                radio.classList.remove('is-invalid', 'is-valid');
            });
            
            if (!isChecked) {
                // No radio selected
                radios.forEach(radio => {
                    radio.classList.add('is-invalid');
                });
                errorDiv.style.display = 'block';
                return false;
            } else {
                // Only add is-valid to the checked radio
                radios.forEach(radio => {
                    if (radio.checked) {
                        radio.classList.add('is-valid');
                    } else {
                        radio.classList.remove('is-valid');
                    }
                });
                errorDiv.style.display = 'none';
                return true;
            }
        }

        // Update form error state
        function updateFormErrorState() {
            const form = document.querySelector('form');
            const card = form.closest('.card');
            const invalidFields = document.querySelectorAll('.is-invalid');
            const errorMessages = document.querySelectorAll('.text-danger, .invalid-feedback[style*="block"]');
            
            if (invalidFields.length > 0 || errorMessages.length > 0) {
                card.classList.add('has-errors');
            } else {
                card.classList.remove('has-errors');
            }
        }

        // Camera functionality
        let stream = null;
        let canvas = null;
        let capturedImageData = null;

        // Open camera modal
        document.getElementById('capture-image-btn').addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('cameraModal'));
            modal.show();
        });

        // Start camera
        document.getElementById('start-camera-btn').addEventListener('click', async function() {
            try {
                // Check if getUserMedia is supported
                if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                    throw new Error('Camera access is not supported in this browser');
                }

                stream = await navigator.mediaDevices.getUserMedia({ 
                    video: { 
                        width: { ideal: 640 },
                        height: { ideal: 480 },
                        facingMode: 'user' // Use front camera if available
                    } 
                });
                
                const video = document.getElementById('camera');
                video.srcObject = stream;
                
                // Show capture button and hide start button
                document.getElementById('start-camera-btn').style.display = 'none';
                document.getElementById('capture-btn').style.display = 'inline-block';
                
            } catch (error) {
                console.error('Error accessing camera:', error);
                let errorMessage = 'Unable to access camera. ';
                
                if (error.name === 'NotAllowedError') {
                    errorMessage += 'Please make sure you have granted camera permissions.';
                } else if (error.name === 'NotFoundError') {
                    errorMessage += 'No camera found on this device.';
                } else if (error.name === 'NotSupportedError') {
                    errorMessage += 'Camera access is not supported in this browser.';
                } else {
                    errorMessage += 'Please try refreshing the page or using a different browser.';
                }
                
                alert(errorMessage);
            }
        });

        // Capture photo
        document.getElementById('capture-btn').addEventListener('click', function() {
            const video = document.getElementById('camera');
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            
            // Set canvas dimensions to match video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            
            // Draw video frame to canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            // Convert to base64 data URL
            capturedImageData = canvas.toDataURL('image/jpeg', 0.8);
            
            // Show captured image
            document.getElementById('captured-image').src = capturedImageData;
            document.getElementById('camera-container').style.display = 'none';
            document.getElementById('captured-image-container').style.display = 'block';
            
            // Show retake and save buttons
            document.getElementById('capture-btn').style.display = 'none';
            document.getElementById('retake-btn').style.display = 'inline-block';
            document.getElementById('save-image-btn').style.display = 'inline-block';
            
            // Stop camera stream
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        });

        // Retake photo
        document.getElementById('retake-btn').addEventListener('click', function() {
            // Reset to camera view
            document.getElementById('camera-container').style.display = 'block';
            document.getElementById('captured-image-container').style.display = 'none';
            document.getElementById('start-camera-btn').style.display = 'inline-block';
            document.getElementById('capture-btn').style.display = 'none';
            document.getElementById('retake-btn').style.display = 'none';
            document.getElementById('save-image-btn').style.display = 'none';
            
            // Clear captured image
            capturedImageData = null;
            document.getElementById('image_path').value = '';
            
            // Hide form preview if it was showing
            document.getElementById('image-preview-section').style.display = 'none';
        });

        // Save photo
        document.getElementById('save-image-btn').addEventListener('click', function() {
            if (capturedImageData) {
                // Store the image data in the hidden input
                document.getElementById('image_path').value = capturedImageData;
                
                // Show image preview in form
                document.getElementById('form-image-preview').src = capturedImageData;
                document.getElementById('image-preview-section').style.display = 'block';
                
                // Show success message
                alert('Photo captured successfully! You can now submit the form.');
                
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('cameraModal'));
                modal.hide();
                
                // Update capture button to show photo was taken
                document.getElementById('capture-image-btn').innerHTML = '<i class="fas fa-check me-2"></i>Photo Captured';
                document.getElementById('capture-image-btn').classList.remove('btn-info');
                document.getElementById('capture-image-btn').classList.add('btn-success');
            }
        });

        // Remove image
        document.getElementById('remove-image-btn').addEventListener('click', function() {
            // Clear the image data
            document.getElementById('image_path').value = '';
            document.getElementById('form-image-preview').src = '';
            document.getElementById('image-preview-section').style.display = 'none';
            
            // Reset capture button
            document.getElementById('capture-image-btn').innerHTML = '<i class="fas fa-camera me-2"></i>Capture Photo';
            document.getElementById('capture-image-btn').classList.remove('btn-success');
            document.getElementById('capture-image-btn').classList.add('btn-info');
            
            // Clear captured image data
            capturedImageData = null;
        });

        // Clean up camera when modal is closed
        document.getElementById('cameraModal').addEventListener('hidden.bs.modal', function() {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            // Reset modal state
            document.getElementById('camera-container').style.display = 'block';
            document.getElementById('captured-image-container').style.display = 'none';
            document.getElementById('start-camera-btn').style.display = 'inline-block';
            document.getElementById('capture-btn').style.display = 'none';
            document.getElementById('retake-btn').style.display = 'none';
            document.getElementById('save-image-btn').style.display = 'none';
            
            // If no image was saved, hide the form preview
            if (!document.getElementById('image_path').value) {
                document.getElementById('image-preview-section').style.display = 'none';
            }
        });

        // Add event listeners for real-time validation
        document.addEventListener('DOMContentLoaded', function() {
            // First, check if page was loaded after a form submission
            const submissionToken = document.querySelector('input[name="submission_token"]')?.value;
            const storageKey = submissionToken ? 'form_submission_' + submissionToken : null;
            
            // If we detect a previous submission, immediately disable the form
            if (storageKey && sessionStorage.getItem(storageKey)) {
                const form = document.querySelector('form');
                const card = form?.closest('.card');
                
                disableSubmitButton();
                if (card) {
                    card.style.opacity = '0.8';
                    card.style.pointerEvents = 'none';
                }
                
                // Show a warning message
                const warningDiv = document.createElement('div');
                warningDiv.className = 'alert alert-warning mt-3';
                warningDiv.innerHTML = '<strong>Notice:</strong> This form has already been submitted. Please refresh the page to create a new patient.';
                form?.parentNode?.insertBefore(warningDiv, form);
                return; // Exit early, don't set up other event listeners
            }
            
            const nameFields = ['last_name', 'first_name'];
            const selectFields = ['brgy_address', 'highest_educational_attainment', 'marital_status', 'monthly_household_income', 'religion'];
            const textInputFields = ['street'];
            const radioFields = ['gender'];
            
            // Name fields validation
            nameFields.forEach(function(fieldId) {
                const field = document.getElementById(fieldId);
                
                if (field) {
                    // Validate on input (real-time)
                    field.addEventListener('input', function() {
                        validateNameField(fieldId);
                        updateFormErrorState();
                    });
                    
                    // Validate on blur (when user leaves the field)
                    field.addEventListener('blur', function() {
                        validateNameField(fieldId);
                        updateFormErrorState();
                    });
                    
                    // Prevent invalid characters from being typed
                    field.addEventListener('keypress', function(e) {
                        const char = String.fromCharCode(e.which);
                        const namePattern = /[A-Za-z\s\-\.']/;
                        
                        if (!namePattern.test(char) && e.which !== 8 && e.which !== 0) {
                            e.preventDefault();
                        }
                    });
                }
            });

            // Select fields validation
            selectFields.forEach(function(fieldId) {
                const field = document.getElementById(fieldId);
                
                if (field) {
                    field.addEventListener('change', function() {
                        validateSelectField(fieldId);
                        updateFormErrorState();
                    });
                    
                    field.addEventListener('blur', function() {
                        validateSelectField(fieldId);
                        updateFormErrorState();
                    });
                }
            });

            // Text input fields validation
            textInputFields.forEach(function(fieldId) {
                const field = document.getElementById(fieldId);
                
                if (field) {
                    field.addEventListener('input', function() {
                        validateTextInputField(fieldId);
                        updateFormErrorState();
                    });
                    
                    field.addEventListener('blur', function() {
                        validateTextInputField(fieldId);
                        updateFormErrorState();
                    });
                }
            });

            // Radio fields validation
            radioFields.forEach(function(fieldName) {
                const radios = document.querySelectorAll(`input[name="${fieldName}"]`);
                
                radios.forEach(function(radio) {
                    radio.addEventListener('change', function() {
                        validateRadioField(fieldName);
                        updateFormErrorState();
                    });
                });
            });

            // Add validation for birth_date field
            const birthDateField = document.getElementById('birth_date');
            if (birthDateField) {
                birthDateField.addEventListener('change', function() {
                    validateBirthDate();
                    updateFormErrorState();
                });
                birthDateField.addEventListener('blur', function() {
                    validateBirthDate();
                    updateFormErrorState();
                });
            }
            
            // Form submission validation
            const form = document.querySelector('form');
            if (form) {
                let isSubmitting = false; 
                let submitButton = document.getElementById('submit-btn');
                let submissionToken = document.querySelector('input[name="submission_token"]').value;
                
             
                const storageKey = 'form_submission_' + submissionToken;
                
                if (sessionStorage.getItem(storageKey)) {
                    disableSubmitButton();
                    const card = form.closest('.card');
                    if (card) {
                        card.style.opacity = '0.8';
                        card.style.pointerEvents = 'none';
                    }
                    alert('This form has already been submitted. Please wait or refresh the page.');
                    return;
                }
                
                if (submitButton) {
                    let clickCount = 0;
                    let lastClickTime = 0;
                    
                    submitButton.addEventListener('click', function(e) {
                        const currentTime = Date.now();
                        
                        if (isSubmitting || sessionStorage.getItem(storageKey) || 
                            (currentTime - lastClickTime < 500 && clickCount > 0)) {
                            console.log('Blocked rapid/duplicate click');
                            e.preventDefault();
                            e.stopPropagation();
                            e.stopImmediatePropagation();
                            return false;
                        }
                        
                        clickCount++;
                        lastClickTime = currentTime;
                        
                        
                        setTimeout(() => {
                            clickCount = 0;
                        }, 1000);
                    }, true);
                }
                
                
                form.addEventListener('submit', function(e) {
                    e.preventDefault(); 
                    
                    if (isSubmitting) {
                        console.log('Already submitting - blocking form submission');
                        return false;
                    }
                    
                    if (sessionStorage.getItem(storageKey)) {
                        console.log('Session storage indicates already submitted - blocking');
                        return false;
                    }
                    
                    isSubmitting = true;
                    sessionStorage.setItem(storageKey, 'true');
                    
                    disableSubmitButton();
                    const card = form.closest('.card');
                    if (card) {
                        card.style.opacity = '0.8';
                        card.style.pointerEvents = 'none';
                        card.classList.add('form-submitting');
                    }
                    
                    let isValid = true;
                    
                    nameFields.forEach(function(fieldId) {
                        if (!validateNameField(fieldId)) {
                            isValid = false;
                        }
                    });

                    selectFields.forEach(function(fieldId) {
                        if (!validateSelectField(fieldId)) {
                            isValid = false;
                        }
                    });

                    textInputFields.forEach(function(fieldId) {
                        if (!validateTextInputField(fieldId)) {
                            isValid = false;
                        }
                    });

                    radioFields.forEach(function(fieldName) {
                        if (!validateRadioField(fieldName)) {
                            isValid = false;
                        }
                    });

                    if (!validateBirthDate()) {
                        isValid = false;
                    }
                    
                    if (!isValid) {
                        isSubmitting = false;
                        sessionStorage.removeItem(storageKey);
                        enableSubmitButton();
                        if (card) {
                            card.style.opacity = '1';
                            card.style.pointerEvents = 'auto';
                            card.classList.remove('form-submitting');
                        }
                        updateFormErrorState();
                        alert('Please fill in all required fields correctly.');
                        return false;
                    }
                    
                    const formData = new FormData(form);
                    
                    fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (response.redirected) {
                            window.location.href = response.url;
                            return;
                        }
                        
                        return response.json().then(data => {
                            if (response.ok) {
                                return data;
                            } else {
                                throw new Error(data.message || 'Submission failed: ' + response.status);
                            }
                        });
                    })
                    .then(data => {
                        if (data && data.success) {
                            alert('Patient created successfully!');
                            
                            if (data.redirect) {
                                window.location.href = data.redirect;
                            } else {
                                window.location.href = "{{ route('patients.index') }}";
                            }
                        } else {
                            throw new Error(data.message || 'Unexpected response format');
                        }
                    })
                    .catch(error => {
                        console.error('Submission error:', error);
                        if (isSubmitting) {
                            isSubmitting = false;
                            sessionStorage.removeItem(storageKey);
                            enableSubmitButton();
                            if (card) {
                                card.style.opacity = '1';
                                card.style.pointerEvents = 'auto';
                                card.classList.remove('form-submitting');
                            }
                            alert('An error occurred while creating the patient. Please try again.');
                        }
                    });
                });
                
                // Block any direct button clicks after submission starts
                if (submitButton) {
                    ['click', 'dblclick', 'mousedown', 'mouseup', 'touchstart', 'touchend'].forEach(eventType => {
                        submitButton.addEventListener(eventType, function(e) {
                            if (isSubmitting || sessionStorage.getItem(storageKey)) {
                                console.log('Blocked button interaction:', eventType);
                                e.preventDefault();
                                e.stopPropagation();
                                e.stopImmediatePropagation();
                                return false;
                            }
                        }, true); 
                    });
                    
                    const originalClick = submitButton.click;
                    submitButton.click = function() {
                        if (isSubmitting || sessionStorage.getItem(storageKey)) {
                            console.log('Blocked programmatic click');
                            return;
                        }
                        originalClick.call(this);
                    };
                }
                
                form.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' && (isSubmitting || sessionStorage.getItem(storageKey))) {
                        e.preventDefault();
                        e.stopPropagation();
                        return false;
                    }
                });
                
                // Cleanup on page unload
                window.addEventListener('beforeunload', function() {
                    if (!document.querySelector('.alert-success')) {
                        sessionStorage.removeItem(storageKey);
                    }
                });
            }
        });

        // Helper functions for submit button state management
        function disableSubmitButton() {
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const submitSpinner = document.getElementById('submit-spinner');
            
            if (submitBtn && submitText && submitSpinner) {
                submitBtn.disabled = true;
                submitBtn.classList.add('disabled');
                submitBtn.setAttribute('disabled', 'disabled');
                submitBtn.setAttribute('aria-disabled', 'true');
                
                // Change text and show spinner
                submitText.textContent = 'Processing...';
                submitSpinner.style.display = 'inline-block';
                
                // Change button color to indicate processing
                submitBtn.classList.remove('btn-success');
                submitBtn.classList.add('btn-secondary');
                
                // Make it completely unclickable with multiple CSS properties
                submitBtn.style.pointerEvents = 'none';
                submitBtn.style.cursor = 'not-allowed';
                submitBtn.style.opacity = '0.6';
                submitBtn.style.userSelect = 'none';
                
                // Remove any hover/focus effects
                submitBtn.style.outline = 'none';
                submitBtn.style.boxShadow = 'none';
                
                // Add data attribute to track state
                submitBtn.setAttribute('data-submitting', 'true');
            }
        }
        
        function enableSubmitButton() {
            const submitBtn = document.getElementById('submit-btn');
            const submitText = document.getElementById('submit-text');
            const submitSpinner = document.getElementById('submit-spinner');
            
            if (submitBtn && submitText && submitSpinner) {
                
                submitBtn.disabled = false;
                submitBtn.classList.remove('disabled');
                submitBtn.removeAttribute('disabled');
                submitBtn.removeAttribute('aria-disabled');
                submitBtn.removeAttribute('data-submitting');
                
               
                submitText.textContent = 'Create Patient';
                submitSpinner.style.display = 'none';
                
               
                submitBtn.classList.remove('btn-secondary');
                submitBtn.classList.add('btn-success');
                
               
                submitBtn.style.pointerEvents = 'auto';
                submitBtn.style.cursor = 'pointer';
                submitBtn.style.opacity = '1';
                submitBtn.style.userSelect = 'auto';
                
                
                submitBtn.style.outline = '';
                submitBtn.style.boxShadow = '';
            }
        }

    </script>

    <style>
        .is-invalid {
            border-color: #dc3545 !important;
            background-color: #fff5f5 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            border-width: 3px !important;
        }
        
        .is-invalid:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.3rem rgba(220, 53, 69, 0.4) !important;
            background-color: #fff5f5 !important;
            border-width: 3px !important;
        }
        
        .is-valid {
            border-color: #28a745 !important;
            background-color: #f8fff9 !important;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
            border-width: 2px !important;
        }
        
        .form-control.is-invalid {
            border: 3px solid #dc3545 !important;
            animation: shake 0.5s ease-in-out;
        }

        /* Shake animation for invalid fields */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Form error styling - makes entire form have red theme when errors exist */
        .has-errors {
            border: 4px solid #dc3545 !important;
            background-color: #fdf2f2 !important;
            box-shadow: 0 0 20px rgba(220, 53, 69, 0.4) !important;
            animation: pulse-red 2s ease-in-out;
        }
        
        @keyframes pulse-red {
            0%, 100% { box-shadow: 0 0 20px rgba(220, 53, 69, 0.4); }
            50% { box-shadow: 0 0 30px rgba(220, 53, 69, 0.6); }
        }
        
        .has-errors legend {
            color: #dc3545 !important;
            font-weight: bold;
            text-shadow: 1px 1px 2px rgba(220, 53, 69, 0.3);
        }
        
        .has-errors hr {
            border-color: #dc3545 !important;
            border-width: 3px !important;
        }
        
        .has-errors .card {
            border-color: #dc3545 !important;
        }

        /* Enhanced error message styling */
        .invalid-feedback {
            display: none !important;
            font-weight: bold;
            color: #dc3545 !important;
            background-color: #fff5f5;
            padding: 8px;
            border-radius: 4px;
            border-left: 4px solid #dc3545;
            margin-top: 5px;
        }

        /* Only show invalid-feedback when there's an error */
        .invalid-feedback[style*="display: block"] {
            display: block !important;
        }

        /* Radio button validation styling */
        .form-check-input.is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }

        /* Use accent-color for green dot inside radio when valid */
        .form-check-input.is-valid[type="radio"] {
            accent-color: #28a745 !important;
            border-color: #28a745 !important;
            box-shadow: none !important;
        }
        .form-check-input.is-valid[type="radio"]:checked {
            background-color: #28a745 !important;
            border-color: #28a745 !important;
            accent-color: #28a745 !important;
        }

        /* Special styling for select fields */
        select.is-invalid {
            border-color: #dc3545 !important;
            background-color: #fff5f5 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            border-width: 3px !important;
        }

        select.is-valid {
            border-color: #28a745 !important;
            background-color: #f8fff9 !important;
            box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25) !important;
            border-width: 2px !important;
        }

        /* Submit button disabled state styling */
        .btn.disabled, .btn:disabled {
            opacity: 0.6 !important;
            cursor: not-allowed !important;
            pointer-events: none !important;
            user-select: none !important;
        }
        
        .btn.disabled .spinner-border {
            animation: spinner-border 0.75s linear infinite;
        }
        
        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }
        
        /* Prevent rapid clicking visual feedback */
        .btn {
            transition: all 0.2s ease-in-out;
        }
        
        .btn:active {
            transform: scale(0.98);
        }
        
        
        .form-submitting {
            pointer-events: none !important;
            user-select: none !important;
            position: relative;
        }
        
        .form-submitting::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1000;
            pointer-events: auto;
        }
        
        .form-submitting * {
            pointer-events: none !important;
        }
        
        
        .form-disabled {
            opacity: 0.7 !important;
            pointer-events: none !important;
            user-select: none !important;
        }
        
        .form-disabled .btn {
            opacity: 0.5 !important;
            cursor: not-allowed !important;
        }
        
        .form-disabled input,
        .form-disabled select,
        .form-disabled textarea {
            background-color: #f8f9fa !important;
            cursor: not-allowed !important;
        }
        
      
        .btn-no-double-click {
            transition: all 0.1s ease-in-out;
        }
        
        .btn-no-double-click:active {
            transform: scale(0.98);
            opacity: 0.8;
        }
        
        .btn-no-double-click.disabled,
        .btn-no-double-click:disabled {
            pointer-events: none !important;
            opacity: 0.5 !important;
            cursor: not-allowed !important;
            transform: none !important;
        }
        
        /* Camera modal styling */
        #cameraModal .modal-lg {
            max-width: 800px;
        }
        
        #camera, #captured-image {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        #camera-container, #captured-image-container {
            min-height: 300px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .btn-group .btn {
            margin: 0 2px;
        }
        
        /* Photo captured button state */
        #capture-image-btn.btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        
        #capture-image-btn.btn-success:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }
        
        /* Image preview styling */
        #image-preview-section {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            border: 2px solid #7CAD3E;
        }
        
        #form-image-preview {
            transition: transform 0.2s ease-in-out;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        
        #form-image-preview:hover {
            transform: scale(1.05);
        }
        
        #remove-image-btn {
            transition: all 0.2s ease-in-out;
            opacity: 0.8;
        }
        
        #remove-image-btn:hover {
            opacity: 1;
            transform: scale(1.1);
        }
        
        /* Camera modal improvements */
        #cameraModal .modal-body {
            padding: 30px;
        }
        
        #camera-container, #captured-image-container {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
        }
    </style>
</x-app-layout>
