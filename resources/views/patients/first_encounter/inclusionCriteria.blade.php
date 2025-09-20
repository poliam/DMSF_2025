<div class="mt-6 p-4 bg-white shadow-md rounded-lg">
    <h2 class="text-xl font-bold">Inclusion Criteria Form</h2>

    <!-- Success message -->
    <div id="inclusion-criteria-message" class="mb-4 p-2 bg-green-100 text-green-700 rounded hidden">
        ✅ Inclusion criteria form already submitted.
    </div>

    <!-- Display errors if there are any -->
    <div id="error-messages" class="text-red-500 mb-4 hidden"></div>

    <!-- Display form answers if already submitted -->
    <div id="inclusion-criteria-answers" class="hidden">
        <h3 class="font-semibold">Submitted Answers:</h3>
        <div id="answers-content"></div>
    </div>

    <div id="inclusion-criteria-form-wrapper">
        <form id="inclusion-criteria-form" method="POST">
            @csrf
            <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">

            <!-- 1. Read and write ability -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Can read, write, and provide consent:</label>
                <select name="read_and_write_consent" class="w-full px-4 py-2 border rounded-lg">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- 2. Consent to provide information -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Consent to provide first-hand and secondary information:</label>
                <select name="consent_for_info" class="w-full px-4 py-2 border rounded-lg">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- 3. Consent for teleconsultation -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Consent for teleconsultation:</label>
                <select name="consent_for_teleconsultation" class="w-full px-4 py-2 border rounded-lg">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- 4. Laboratory finding HbA1c or RBS -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Laboratory finding (FBS ≥ 126 or RBS ≥200 mg/dL):</label>
                <select name="laboratory_finding" class="w-full px-4 py-2 border rounded-lg">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>

            <!-- HbA1c Result -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">FBS result (mg/dL):</label>
                <input type="number" name="fbs_result" class="w-full px-4 py-2 border rounded-lg" step="0.1" min="0">
                <small class="text-gray-500">Normal: Below 100 mg/dL, Prediabetes: 100 - 126 mg/dL, Diabetes: 127 mg/dL or higher</small>
            </div>

            <!-- RBS Result -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">RBS result (mg/dL):</label>
                <input type="number" name="rbs_result" class="w-full px-4 py-2 border rounded-lg">
                <small class="text-gray-500">Normal: Below 140 mg/dL, Prediabetes: 140-199 mg/dL, Diabetes: 200 mg/dL or higher</small>
            </div>

            <!-- 5. Symptoms (Polyuria, Polydipsia, Polyphagia) -->
            <div class="mb-4">
                <label class="block font-medium text-gray-700">Symptoms:</label>
                <div class="flex items-center">
                    <input type="hidden" name="polyuria" value="0">
                    <input type="checkbox" name="polyuria" value="1" class="mr-2"> Polyuria

                    <input type="hidden" name="polydipsia" value="0">
                    <input type="checkbox" name="polydipsia" value="1" class="ml-4 mr-2"> Polydipsia

                    <input type="hidden" name="polyphagia" value="0">
                    <input type="checkbox" name="polyphagia" value="1" class="ml-4 mr-2"> Polyphagia
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-center mt-2 md:mt-4 lg:mt-6">
            <button type="submit" class="bg-[#7CAD3E] hover:bg-[#1A5D77] text-white border-none px-3 py-2 rounded-full text-base mt-3 cursor-pointer transition-colors duration-300">
                Submit Inclusion Criteria Form
            </button>
            </div>
        </form>
    </div>
</div>

<script>
$(document).ready(function() {
    let patientId = $('#patient_id').val();

    // First, check if the form has already been submitted when the page loads
    $.get(`/research-eligibility/check/${patientId}`, function(response) {
        if (response.form_exists) {
            // Hide the form and show the submission message with the answers
            $('#inclusion-criteria-form-wrapper').addClass('hidden');
            $('#inclusion-criteria-message').removeClass('hidden');
            displayAnswers(response.data);
        } else {
            // The form hasn't been submitted yet, so show the form (default behavior)
            $('#inclusion-criteria-form-wrapper').removeClass('hidden');
            $('#inclusion-criteria-message').addClass('hidden');
        }
    });

    // Handle form submission
    $('#inclusion-criteria-form').submit(function(e) {
        e.preventDefault();

        // Clear any previous error messages
        $('#error-messages').addClass('hidden').html('');

        $.ajax({
            url: "{{ route('research_eligibility.store') }}",
            method: "POST",
            data: $(this).serialize(),
            success: function(response) {
                // Check if response indicates success
                if (response && (response.success !== false)) {
                    // Hide the form and show the submission message
                    $('#inclusion-criteria-form-wrapper').addClass('hidden');
                    $('#inclusion-criteria-message').removeClass('hidden');
                    
                    // Display the submitted answers
                    displayAnswers(response.data);
                    
                    // Optional: Show a temporary success notification without alert
                    if (response.message) {
                        showTemporaryNotification('Success! ' + response.message, 'success');
                    }
                } else {
                    // Handle case where response indicates failure
                    showTemporaryNotification('Error: ' + (response.message || 'Form submission failed'), 'error');
                }
            },
            error: function(xhr) {
                // Handle validation errors or server errors
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    let errorList = '<ul>';
                    $.each(errors, function(key, value) {
                        errorList += '<li>' + value[0] + '</li>';
                    });
                    errorList += '</ul>';
                    $('#error-messages').html(errorList).removeClass('hidden');
                } else {
                    let errorMessage = xhr.responseJSON && xhr.responseJSON.message 
                        ? xhr.responseJSON.message 
                        : 'There was an issue with the form submission.';
                    showTemporaryNotification('Error: ' + errorMessage, 'error');
                }
            }
        });
    });

    function displayAnswers(data) {
    // Define the fbs result categories
    let fbsCondition = getfbsCondition(data.fbs_result);

    // Define the RBS result categories
    let rbsCondition = getRbsCondition(data.rbs_result);

    // Display the submitted data in the "answers-content" div
    let answersHtml = `
        <p><strong>Read and Write Consent:</strong> ${data.read_and_write_consent == 1 ? 'Yes' : 'No'}</p>
        <p><strong>Consent for Info:</strong> ${data.consent_for_info == 1 ? 'Yes' : 'No'}</p>
        <p><strong>Consent for Teleconsultation:</strong> ${data.consent_for_teleconsultation == 1 ? 'Yes' : 'No'}</p>
        <p><strong>Laboratory Finding:</strong> ${data.laboratory_finding == 1 ? 'Yes' : 'No'}</p>
        <p><strong>FBS Result:</strong> ${data.fbs_result} (${fbsCondition})</p>
        <p><strong>RBS Result:</strong> ${data.rbs_result} (${rbsCondition})</p>
        <p><strong>Polyuria:</strong> ${data.polyuria == 1 ? 'Yes' : 'No'}</p>
        <p><strong>Polydipsia:</strong> ${data.polydipsia == 1 ? 'Yes' : 'No'}</p>
        <p><strong>Polyphagia:</strong> ${data.polyphagia == 1 ? 'Yes' : 'No'}</p>
    `;
    $('#answers-content').html(answersHtml);
    $('#inclusion-criteria-answers').removeClass('hidden');
}

// Function to determine HbA1c result condition
function getfbsCondition(fbs) {
    if (fbs < 100) {
        return 'Normal';
    } else if (fbs >= 100 && fbs < 126) {
        return 'Prediabetes';
    } else {
        return 'Diabetes';
    }
}

// Function to determine RBS result condition
function getRbsCondition(rbs) {
    if (rbs < 140) {
        return 'Normal';
    } else if (rbs >= 140 && rbs < 200) {
        return 'Prediabetes';
    } else {
        return 'Diabetes';
    }
}

function showTemporaryNotification(message, type) {
    // Create notification element
    let notificationClass = type === 'success' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700';
    let notification = $(`
        <div class="fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg ${notificationClass} max-w-sm">
            <div class="flex items-center">
                <span class="mr-2">${type === 'success' ? '✅' : '❌'}</span>
                <span>${message}</span>
            </div>
        </div>
    `);
    
    // Add to body
    $('body').append(notification);
    
    // Remove after 5 seconds
    setTimeout(function() {
        notification.fadeOut(300, function() {
            $(this).remove();
        });
    }, 5000);
}

});
</script>
