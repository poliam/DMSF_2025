<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="bg-white rounded shadow-sm p-4">
                <!-- Physician Notes Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3 text-primary">
                        <i class="fas fa-user-md me-2"></i>Physician Notes
                    </h5>
                    <div class="form-group">
                        <textarea class="form-control notes-textarea" id="physician-notes" name="physician_notes" rows="6" 
                                  placeholder="Enter physician notes here..." {{ !empty($patient->physician_notes) ? 'readonly' : '' }}>{{ $patient->physician_notes ?? '' }}</textarea>
                    </div>
                    <div class="text-end mt-2">
                        @if(!empty($patient->physician_notes))
                            <button type="button" class="btn btn-secondary btn-sm edit-notes-btn me-2" data-type="physician">
                                <i class="fas fa-edit me-1"></i>Edit Notes
                            </button>
                            <button type="button" class="btn btn-danger btn-sm delete-notes-btn me-2" data-type="physician">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                            <button type="button" class="btn btn-primary btn-sm save-notes-btn d-none" data-type="physician">
                                <i class="fas fa-save me-1"></i>Save Changes
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm cancel-edit-btn d-none" data-type="physician">
                                <i class="fas fa-times me-1"></i>Cancel
                            </button>
                        @else
                            <button type="button" class="btn btn-primary btn-sm save-notes-btn" data-type="physician">
                                <i class="fas fa-save me-1"></i>Save Physician Notes
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Allied Health Staff Notes Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3 text-success">
                        <i class="fas fa-user-nurse me-2"></i>Allied Health Staff Notes
                    </h5>
                    <div class="form-group">
                        <textarea class="form-control notes-textarea" id="allied-health-notes" name="allied_health_notes" rows="6" 
                                  placeholder="Enter allied health staff notes here..." {{ !empty($patient->allied_health_notes) ? 'readonly' : '' }}>{{ $patient->allied_health_notes ?? '' }}</textarea>
                    </div>
                    <div class="text-end mt-2">
                        @if(!empty($patient->allied_health_notes))
                            <button type="button" class="btn btn-secondary btn-sm edit-notes-btn me-2" data-type="allied_health">
                                <i class="fas fa-edit me-1"></i>Edit Notes
                            </button>
                            <button type="button" class="btn btn-danger btn-sm delete-notes-btn me-2" data-type="allied_health">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                            <button type="button" class="btn btn-success btn-sm save-notes-btn d-none" data-type="allied_health">
                                <i class="fas fa-save me-1"></i>Save Changes
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm cancel-edit-btn d-none" data-type="allied_health">
                                <i class="fas fa-times me-1"></i>Cancel
                            </button>
                        @else
                            <button type="button" class="btn btn-success btn-sm save-notes-btn" data-type="allied_health">
                                <i class="fas fa-save me-1"></i>Save Allied Health Notes
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Admin/IT/Researcher Notes Section -->
                <div class="mb-4">
                    <h5 class="border-bottom pb-2 mb-3 text-info">
                        <i class="fas fa-users-cog me-2"></i>Admin/IT/Researcher Notes
                    </h5>
                    <div class="form-group">
                        <textarea class="form-control notes-textarea" id="admin-notes" name="admin_notes" rows="6" 
                                  placeholder="Enter admin, IT, or researcher notes here..." {{ !empty($patient->admin_notes) ? 'readonly' : '' }}>{{ $patient->admin_notes ?? '' }}</textarea>
                    </div>
                    <div class="text-end mt-2">
                        @if(!empty($patient->admin_notes))
                            <button type="button" class="btn btn-secondary btn-sm edit-notes-btn me-2" data-type="admin">
                                <i class="fas fa-edit me-1"></i>Edit Notes
                            </button>
                            <button type="button" class="btn btn-danger btn-sm delete-notes-btn me-2" data-type="admin">
                                <i class="fas fa-trash me-1"></i>Delete
                            </button>
                            <button type="button" class="btn btn-info btn-sm save-notes-btn d-none" data-type="admin">
                                <i class="fas fa-save me-1"></i>Save Changes
                            </button>
                            <button type="button" class="btn btn-outline-secondary btn-sm cancel-edit-btn d-none" data-type="admin">
                                <i class="fas fa-times me-1"></i>Cancel
                            </button>
                        @else
                            <button type="button" class="btn btn-info btn-sm save-notes-btn" data-type="admin">
                                <i class="fas fa-save me-1"></i>Save Admin/IT/Researcher Notes
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
console.log('Notes script loading...');

$(document).ready(function() {
    console.log('Notes script ready');
    
    // Store original content for cancel functionality
    let originalContent = {};
    
    // Edit button functionality - Use event delegation
    $(document).on('click', '.edit-notes-btn', function(e) {
        e.preventDefault();
        console.log('Edit button clicked');
        
        const noteType = $(this).data('type');
        const textarea = $(`#${noteType === 'allied_health' ? 'allied-health' : noteType}-notes`);
        const section = $(this).closest('.mb-4');
        
        // Store original content
        originalContent[noteType] = textarea.val();
        
        // Enable textarea
        textarea.removeAttr('readonly').focus();
        
        // Toggle button visibility
        section.find('.edit-notes-btn, .delete-notes-btn').addClass('d-none');
        section.find('.save-notes-btn, .cancel-edit-btn').removeClass('d-none');
    });
    
    // Cancel edit functionality
    $(document).on('click', '.cancel-edit-btn', function(e) {
        e.preventDefault();
        console.log('Cancel button clicked');
        
        const noteType = $(this).data('type');
        const textarea = $(`#${noteType === 'allied_health' ? 'allied-health' : noteType}-notes`);
        const section = $(this).closest('.mb-4');
        
        // Restore original content
        textarea.val(originalContent[noteType]);
        
        // Disable textarea
        textarea.attr('readonly', true);
        
        // Toggle button visibility
        section.find('.edit-notes-btn, .delete-notes-btn').removeClass('d-none');
        section.find('.save-notes-btn, .cancel-edit-btn').addClass('d-none');
    });
    
    // Delete button functionality
    $(document).on('click', '.delete-notes-btn', function(e) {
        e.preventDefault();
        console.log('Delete button clicked');
        
        const noteType = $(this).data('type');
        const section = $(this).closest('.mb-4');
        
        if(confirm('Are you sure you want to delete this note?')) {
            console.log('Confirmed delete for:', noteType);
            
            // Get CSRF token
            let token = $('meta[name="csrf-token"]').attr('content');
            if (!token) {
                token = $('input[name="_token"]').val();
            }
            console.log('Token found:', token ? 'Yes' : 'No');
            
            // Delete the note
            $.ajax({
                url: `/patients/{{ $patient->id }}/save-notes`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                    field: noteType === 'allied_health' ? 'allied_health_notes' : noteType + '_notes',
                    content: ''
                },
                success: function(response) {
                    console.log('Delete response:', response);
                    alert('Notes deleted successfully!');
                    
                    // Convert to new note state
                    const textarea = $(`#${noteType === 'allied_health' ? 'allied-health' : noteType}-notes`);
                    textarea.val('').removeAttr('readonly');
                    
                    // Update button layout
                    const buttonText = {
                        'physician': 'Save Physician Notes',
                        'allied_health': 'Save Allied Health Notes', 
                        'admin': 'Save Admin/IT/Researcher Notes'
                    };
                    const buttonClass = noteType === 'physician' ? 'btn-primary' : noteType === 'allied_health' ? 'btn-success' : 'btn-info';
                    
                    section.find('.text-end').html(`
                        <button type="button" class="btn ${buttonClass} btn-sm save-notes-btn" data-type="${noteType}">
                            <i class="fas fa-save me-1"></i>${buttonText[noteType]}
                        </button>
                    `);
                },
                error: function(xhr, status, error) {
                    console.log('Delete error:', xhr.responseText, status, error);
                    alert('Failed to delete notes: ' + (xhr.responseJSON?.message || error));
                }
            });
        }
    });
    
    // Save notes functionality
    $(document).on('click', '.save-notes-btn', function(e) {
        e.preventDefault();
        console.log('Save button clicked');
        
        const noteType = $(this).data('type');
        const section = $(this).closest('.mb-4');
        let noteContent, fieldName, textareaId;
        
        // Get field mapping
        switch(noteType) {
            case 'physician':
                textareaId = 'physician-notes';
                noteContent = $('#physician-notes').val();
                fieldName = 'physician_notes';
                break;
            case 'allied_health':
                textareaId = 'allied-health-notes';
                noteContent = $('#allied-health-notes').val();
                fieldName = 'allied_health_notes';
                break;
            case 'admin':
                textareaId = 'admin-notes';
                noteContent = $('#admin-notes').val();
                fieldName = 'admin_notes';
                break;
        }
        
        console.log('Saving:', noteType, 'Content length:', noteContent ? noteContent.length : 0);
        
        const textarea = $(`#${textareaId}`);
        const hasEditButton = section.find('.edit-notes-btn').length > 0;
        
        // Get CSRF token
        let token = $('meta[name="csrf-token"]').attr('content');
        if (!token) {
            token = $('input[name="_token"]').val();
        }
        console.log('Save token found:', token ? 'Yes' : 'No');
        
        // Check if content is empty when editing existing note
        if (hasEditButton && noteContent.trim() === '') {
            console.log('Empty content - clearing note');
            
            $.ajax({
                url: `/patients/{{ $patient->id }}/save-notes`,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                    field: fieldName,
                    content: ''
                },
                success: function(response) {
                    console.log('Clear response:', response);
                    alert('Notes cleared successfully!');
                    
                    // Convert to new note state
                    textarea.val('').removeAttr('readonly');
                    
                    const buttonText = {
                        'physician': 'Save Physician Notes',
                        'allied_health': 'Save Allied Health Notes', 
                        'admin': 'Save Admin/IT/Researcher Notes'
                    };
                    const buttonClass = noteType === 'physician' ? 'btn-primary' : noteType === 'allied_health' ? 'btn-success' : 'btn-info';
                    
                    section.find('.text-end').html(`
                        <button type="button" class="btn ${buttonClass} btn-sm save-notes-btn" data-type="${noteType}">
                            <i class="fas fa-save me-1"></i>${buttonText[noteType]}
                        </button>
                    `);
                },
                error: function(xhr, status, error) {
                    console.log('Clear error:', xhr.responseText, status, error);
                    alert('Failed to clear notes: ' + (xhr.responseJSON?.message || error));
                }
            });
            return;
        }
        
        // Normal save process
        console.log('Processing normal save, hasEditButton:', hasEditButton);
        
        if (hasEditButton) {
            // Existing note - make read-only immediately
            textarea.attr('readonly', true);
            section.find('.edit-notes-btn, .delete-notes-btn').removeClass('d-none');
            section.find('.save-notes-btn, .cancel-edit-btn').addClass('d-none');
            originalContent[noteType] = noteContent;
        } else {
            // New note - create edit/delete buttons immediately
            textarea.attr('readonly', true);
            
            const buttonClass = noteType === 'physician' ? 'btn-primary' : noteType === 'allied_health' ? 'btn-success' : 'btn-info';
            
            section.find('.text-end').html(`
                <button type="button" class="btn btn-secondary btn-sm edit-notes-btn me-2" data-type="${noteType}">
                    <i class="fas fa-edit me-1"></i>Edit Notes
                </button>
                <button type="button" class="btn btn-danger btn-sm delete-notes-btn me-2" data-type="${noteType}">
                    <i class="fas fa-trash me-1"></i>Delete
                </button>
                <button type="button" class="btn ${buttonClass} btn-sm save-notes-btn d-none" data-type="${noteType}">
                    <i class="fas fa-save me-1"></i>Save Changes
                </button>
                <button type="button" class="btn btn-outline-secondary btn-sm cancel-edit-btn d-none" data-type="${noteType}">
                    <i class="fas fa-times me-1"></i>Cancel
                </button>
            `);
            
            originalContent[noteType] = noteContent;
        }
        
        // Show success notification
        alert('Saving notes...');
        
        // Save to server
        $.ajax({
            url: `/patients/{{ $patient->id }}/save-notes`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                field: fieldName,
                content: noteContent
            },
            success: function(response) {
                console.log('Save response:', response);
                alert('Notes saved successfully!');
            },
            error: function(xhr, status, error) {
                console.log('Save error:', xhr.responseText, status, error);
                alert('Failed to save notes: ' + (xhr.responseJSON?.message || error));
                
                // Revert UI changes on error
                if (hasEditButton) {
                    textarea.removeAttr('readonly');
                    section.find('.edit-notes-btn, .delete-notes-btn').addClass('d-none');
                    section.find('.save-notes-btn, .cancel-edit-btn').removeClass('d-none');
                } else {
                    // Reset to new note state
                    textarea.removeAttr('readonly');
                    const buttonText = {
                        'physician': 'Save Physician Notes',
                        'allied_health': 'Save Allied Health Notes', 
                        'admin': 'Save Admin/IT/Researcher Notes'
                    };
                    const buttonClass = noteType === 'physician' ? 'btn-primary' : noteType === 'allied_health' ? 'btn-success' : 'btn-info';
                    
                    section.find('.text-end').html(`
                        <button type="button" class="btn ${buttonClass} btn-sm save-notes-btn" data-type="${noteType}">
                            <i class="fas fa-save me-1"></i>${buttonText[noteType]}
                        </button>
                    `);
                }
            }
        });
    });
});
</script>
