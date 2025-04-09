Test	Description
✅ a_user_can_be_registered_with_valid_data	==> Création réussie avec les champs requis (name, email, password, role)
❌ registration_fails_if_email_is_already_taken ==>	Échec si l’email est déjà utilisé
❌ registration_fails_if_passwords_do_not_match	 ==> Échec si la confirmation du mot de passe ne correspond pas
❌ registration_fails_with_missing_fields ==>	Échec si des champs requis sont absents
❌ role_must_be_valid ==> Échec si la valeur du champ role est invalide (si tu as une règle de validation)
