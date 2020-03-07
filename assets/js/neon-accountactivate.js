/**
 *	Neon Register Script
 *
 *	Developed by Arlind Nushi - www.laborator.co
 */

var neonAccountActivate = neonAccountActivate || {};

;(function($, window, undefined)
{
	"use strict";
	
	$(document).ready(function()
	{
		neonAccountActivate.$container = $("#form_account_activate");
		neonAccountActivate.$steps = neonAccountActivate.$container.find(".form-steps");
		neonAccountActivate.$steps_list = neonAccountActivate.$steps.find(".step");
		neonAccountActivate.step = 'step-1'; // current step
		
				
		neonAccountActivate.$container.validate({
			rules: {
				
				email: {
					required: true,
					email: true
				}
			},
			
			messages: {
				
				email: {
					email: 'Invalid E-mail.'
				}	
			},
			
			highlight: function(element){
				$(element).closest('.input-group').addClass('validate-has-error');
			},
			
			
			unhighlight: function(element)
			{
				$(element).closest('.input-group').removeClass('validate-has-error');
			},
			
			submitHandler: function(ev)
			{
				$(".login-page").addClass('logging-in');
				$(".form-login-error").slideUp('fast');
				//$(".form-login-error").css("display" , "none");
				
				// We consider its 30% completed form inputs are filled
				neonAccountActivate.setPercentage(30, function()
				{
					// Lets move to 98%, meanwhile ajax data are sending and processing
					neonAccountActivate.setPercentage(98, function()
					{
						// Send data to the server
						$.ajax({
							url: baseurl + 'index.php?login/ajax_forgot_password',
							method: 'POST',
							dataType: 'json',
							data: {
								email: $("input#email").val(),
							},
							error: function()
							{
								alert("An error occoured!");
							},
							success: function(response)
							{
								// From response you can fetch the data object retured
								var email = response.submitted_data.email;

								var status= response.status;
								
								
								// Form is fully completed, we update the percentage
								neonAccountActivate.setPercentage(100);
								
								
								// We will give some time for the animation to finish, then execute the following procedures	
								setTimeout(function()
								{
									// Hide the description title
									$(".login-page .login-header .description").slideUp();
									// Remove loging-in state
									$(".login-page").removeClass('logging-in');
									if (status == 'true')
									{

										
										// Hide the register form (steps)
										neonAccountActivate.$steps.slideUp('normal', function()
										{
											
											// Now we show the success message
											
												$(".form-AccountActivate-success").slideDown('normal');
											
											// You can use the data returned from response variable
										});
									}
									else if (status == 'false')
									{

										$(".form-login-error").slideUp('fast');
										$(".form-login-error").css("display" , "block");
									}
									
									
								}, 100);
							}
						});
					});
				});
			}
		});
	
		// Steps Handler
		neonAccountActivate.$steps.find('[data-step]').on('click', function(ev)
		{
			ev.preventDefault();
			
			var $current_step = neonAccountActivate.$steps_list.filter('.current'),
				next_step = $(this).data('step'),
				validator = neonAccountActivate.$container.data('validator'),
				errors = 0;
			
			neonAccountActivate.$container.valid();
			errors = validator.numberOfInvalids();
			
			if(errors)
			{
				validator.focusInvalid();
			}
			else
			{
				var $next_step = neonAccountActivate.$steps_list.filter('#' + next_step),
					$other_steps = neonAccountActivate.$steps_list.not( $next_step ),
					
					current_step_height = $current_step.data('height'),
					next_step_height = $next_step.data('height');
				
				TweenMax.set(neonAccountActivate.$steps, {css: {height: current_step_height}});
				TweenMax.to(neonAccountActivate.$steps, 0.6, {css: {height: next_step_height}});
				
				TweenMax.to($current_step, .3, {css: {autoAlpha: 0}, onComplete: function()
				{
					$current_step.attr('style', '').removeClass('current');
					
					var $form_elements = $next_step.find('.form-group');
					
					TweenMax.set($form_elements, {css: {autoAlpha: 0}});
					$next_step.addClass('current');
					
					$form_elements.each(function(i, el)
					{
						var $form_element = $(el);
						
						TweenMax.to($form_element, .2, {css: {autoAlpha: 1}, delay: i * .09});
					});
					
					setTimeout(function()
					{
						$form_elements.add($next_step).add($next_step).attr('style', '');
						$form_elements.first().find('input').focus();
						
					}, 1000 * (.5 + ($form_elements.length - 1) * .09));
				}});
			}
		});
		
		neonAccountActivate.$steps_list.each(function(i, el)
		{
			var $this = $(el),
				is_current = $this.hasClass('current'),
				margin = 20;
			
			if(is_current)
			{
				$this.data('height', $this.outerHeight() + margin);
			}
			else
			{
				$this.addClass('current').data('height', $this.outerHeight() + margin).removeClass('current');
			}
		});
		
		
		// Login Form Setup
		neonAccountActivate.$body = $(".login-page");
		neonAccountActivate.$login_progressbar_indicator = $(".login-progressbar-indicator h3");
		neonAccountActivate.$login_progressbar = neonAccountActivate.$body.find(".login-progressbar div");
		
		neonAccountActivate.$login_progressbar_indicator.html('0%');
		
		if(neonAccountActivate.$body.hasClass('login-form-fall'))
		{
			var focus_set = false;
			
			setTimeout(function(){ 
				neonAccountActivate.$body.addClass('login-form-fall-init')
				
				setTimeout(function()
				{
					if( !focus_set)
					{
						neonAccountActivate.$container.find('input:first').focus();
						focus_set = true;
					}
					
				}, 550);
				
			}, 0);
		}
		else
		{
			neonAccountActivate.$container.find('input:first').focus();
		}
		
		
		// Functions
		$.extend(neonAccountActivate, {
			setPercentage: function(pct, callback)
			{
				pct = parseInt(pct / 100 * 100, 10) + '%';
				
				// Normal Login
				neonAccountActivate.$login_progressbar_indicator.html(pct);
				neonAccountActivate.$login_progressbar.width(pct);
				
				var o = {
					pct: parseInt(neonAccountActivate.$login_progressbar.width() / neonAccountActivate.$login_progressbar.parent().width() * 100, 10)
				};
				
				TweenMax.to(o, .7, {
					pct: parseInt(pct, 10),
					roundProps: ["pct"],
					ease: Sine.easeOut,
					onUpdate: function()
					{
						neonAccountActivate.$login_progressbar_indicator.html(o.pct + '%');
					},
					onComplete: callback
				});
			}
		});
	});
	
})(jQuery, window);