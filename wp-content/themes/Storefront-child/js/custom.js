   
   

    jQuery(document).ready(function($) {
        
        // Handle "Next Step" button click (move from Step 1 to Step 2)
        jQuery('#next-step').on('click', function(e) {
            e.preventDefault();

            var isValid = true;
            var missingFields = [];
            var fieldsToCheck = [
                '#billing_first_name', 
                '#billing_last_name', 
                '#billing_address_1', 
                '#billing_city', 
                '#billing_postcode', 
                '#billing_phone', 
                '#billing_email_field', 
                '#select2-billing_country-container', 
                '#select2-billing_state-container'
            ];
            fieldsToCheck.forEach(function(selector) {
                var field = $(selector);
                if (field.is('input[type="text"]') || field.is('input[type="tel"]') || field.is('input[type="email"]') || field.is('input[type="number"]') || field.is('textarea')) {
                    if (field.val() === '') {
                        isValid = false;
                        var label = field.closest('.form-row').find('label').text();
                        missingFields.push(label || "This field");
                    }
                }
                // For select2 elements, check the selected value
                else if (field.is('span.select2-selection') && field.text().trim() === ' ') {
                    isValid = false;
                    missingFields.push("Country / State");
                }
            });
    
            // If validation fails, show an error message with the list of missing fields
            if (!isValid) {
                var errorMessage = 'Please fill in the following required fields:\n\n' + missingFields.join('\n');
                alert(errorMessage);
            } else {
                // If validation passes, hide Step 1 and show Step 2
                $('#step-1').hide();  // Hide Step 1
                $('#step-2').show();  // Show Step 2
                $('#progress-bar').css('width', '100%');  // Update progress bar
            }
        });

        // jQuery('#previous-step').on('click', function(e) {
        //     e.preventDefault();
        // });
    

        // Handle "Place Order" button click (submit checkout form in Step 2)
        // jQuery('#place-order').on('click', function(e) {
        //     e.preventDefault();
        //     jQuery('form.checkout').submit();  // Submit the WooCommerce checkout form
        // });

        
    });
    jQuery(document).ready(function($) {
        // Log if the document is ready
        console.log('Document is ready');
    
        // Use event delegation to bind to the dynamically added 'Previous Step' button
        $('body').on('click', '#previous-step', function(e) {
            e.preventDefault();
     // If validation passes, hide Step 1 and show Step 2
     $('#step-1').show();  // Hide Step 1
     $('#step-2').hide();  // Show Step 2
     $('#progress-bar').css('width', '0%'); 
        });
    });


