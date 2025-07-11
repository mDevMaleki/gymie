$(document).ready(function() {
				$('#paymentsform').bootstrapValidator({
					fields: {
						payment_amount: {
							validators: {
								notEmpty: {
									message: 'The amount is required and can\'t be empty'
								},
							}
						},
						invoice_id: {
							  validators: {
								  notEmpty: {
                                                                        message: '\u0634\u0645\u0627\u0631\u0647 \u0635\u0648\u0631\u062a\u062d\u0633\u0627\u0628 \u0644\u0632\u0648\u0645\u0627 \u0628\u0627\u06cc\u062f \u0648\u0627\u0631\u062f \u0634\u0648\u062f'
								}
							}
						},
						date: {
							  validators: {
								  notEmpty: {
									message: 'The cheque date is required and can\'t be empty'
								}
							}
						},
						number: {
							  validators: {
								  notEmpty: {
									message: 'The cheque number is required and can\'t be empty'
								}
							}
						},
					}
				});
			});