(function($,W,D)
{var JQUERY4U = {};
JQUERY4U.UTIL ={setupFormValidation: function(){
            //form candidat front office
            /////////////////////////////////////////////////////
            $("#form_candidat").validate({
                rules: {
                    login: {
                        required: true,
                        maxlength: 50
                    },
                    pass: {
                        required: true,
                        maxlength: 20
                    }
                },
                messages: {
                    login: "Veuillez entrez un email valide",
                    pass: "Veuillez entrez un mot de passe "
                },    
                submitHandler: function(form) {
                    form.submit();
                }
            });
            //form contact nous + signaler probléme front office
            /////////////////////////////////////////////////////
            $("#form_contact").validate({
                rules: {
                    destination: "required",
                    user_last_name: "required",
                    user_email: "required",
                    user_first_name: "required",
                    subject: "required",
                    msg: "required",
                },
                messages: {
                    destination: "Veuillez selectionnez une destination",
                    user_last_name: "Veuillez entrez le nom de famille ",
                    user_first_name: "Veuillez entrez le prénom",
                    user_email: "Veuillez entrez un email valide",
                    subject: "Veuillez entrez le sujet",
                    msg: "Veuillez entrez le message",
                },    
                submitHandler: function(form) {
                    form.submit();
                }
            });
            //form standard mot de passe oublié + 
            ////////////////////////////////////////////////////////
            $("#form_standard").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 5
                    },
                     password1: {
                      equalTo: "#password"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            $("#form_pop_status").validate({
                rules: {
                    password: {
                        required: true,
                        minlength: 5
                    },
                     password1: {
                      equalTo: "#password"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            
            // form inscription + changer mot de passe
            /////////////////////////////////////////////////////
            $("#form_inscription").validate({
                rules: {
                    mdp1: {
                        required: true,
                        minlength: 5
                    },
                     mdp2: {
                      equalTo: "#mdp1"
                    }
                },
                messages: {
                    mdp2: {
                        required: "S'il vous plaît fournir un mot de passe",
                        minlength: "Votre mot de passe doit comporter au moins 5 caractères"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
            //
            ////////////////////////////////////////////////////////////////
            $("#signups").validate({
                rules: {
                    contact_us: "required",
                    user_last_name: "required",
                    user_first_name: "required",
                    subject: "required",
                    msg: "required",
                    user_email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                     mdp2: {
                      equalTo: "#mdp1"
                    },
                    agree: "required"
                },
                messages: {
                    contact_us: "Please enter your firstname",
                    user_last_name: "Veuillez entrez le nom de famille ",
                    user_first_name: "Veuillez entrez le prénom",
                    subject: "Veuillez entrez le sujet",
                    msg: "Veuillez entrez le message",
                    user_email: "Veuillez entrez un email valide",
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 5 characters long"
                    },
                    agree: "Please accept our policy"
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);

