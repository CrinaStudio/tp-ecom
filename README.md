KATA : VENTE DES PRODUITS VARIÉS EN PÉRIODE DE SOLDE
Dans ce KATA l'idée est de simuler les achats des utilisateurs en période de forte demande
sur une plateforme E-COMMERCE.

La plateforme Le Djoor permet à tous les utilisateurs de bénéficier des produits variés à des prix bas durant la période solde.

## BESOINS UTILISATEURS
Pour ce faire, l'utilisateur sur la plateforme pourra éffectuer les actions suivantes :

- Ajouter un produit dans son panier, après l'avoir sélectionné via une liste de base ou après une recherche du produit par son nom.
- Le panier de l'utilisateur doit toujours présenter de manière visible le nombre de produits sélectionnés, la quantité, le coût par produit, le cout total du panier.
- A la validation du panier l'utilisateur est rédirigé vers une page de paiement ou il doit fournir ses informations de paiements pour finaliser son achat.
- Après validation de l'achat une facture est envoyé par mail aux clients.
- Le client aura la possibilité d'annuler son achat.
- Lors de l'achat le client à la possibilité de choisir l'option de livraison à domicile ce qui entraine des coûts supplémentaires 
de livraison ou l'option de retrait en magasin dans l'un des points Le Djoor
- L'utilisateur a la possibilité de faire livrer son achat en tant que cadeau à une adresse voulue, 
ce type d'achat inclus des frais supplémentaire de conservation et emballage en tant que cadeau
- Un achat de type cadeau peut être de type Simple, Anniversaire, Mariage. Chaque type implique un coût spécifique.
- A la connexion l'utilisateur récupère son panier non payé

## CONTRAINTE UTILISATEUR

- Tous les produits Le Djoor bénéficient d'une réduction sur leur prix vente durant la période de solde qui est définie par l'admin. 
Il définira aussi le pourcentage, le nombre de produits.

- Notion de codes promo : le client peut utiliser un code promo pour effectuer ses achats,
le propriétaire du code promo reçoit un pourcentage 

- Hors période de solde un produit peut avoir une réduction spécifique de 5% décidé par l'équipe dirigeante

- Lors de l'achat d'un produit, un utilisateur durant la période solde ne peut pendre plus de 20 unités d'un même produit.

- A plus de 5 produits différents avec au moins 2 unités par produit l'utilisateur bénéficie d'une remise globale de 5% 
sur son achat hors mis les frais de livraison et cadeaux (si l'utilisateur choisit ces options)

- A plus de 10 produits différents avec au moins 4 unités par produit l'utilisateur bénéficie d'une remise globale de 10%
sur son achat hors mis les frais de livraison et cadeaux (si l'utilisateur choisit ces options)

- L'annulation d'un achat se fait dans un délai de temps maximum défini par l'admin après son achat

- Un utilisateur connecté a accès à son panier (email+pwd+nom).
- Un utilisateur ne doit pas se retrouver avec 2 paniers non payés.

## CONTRAINTE GLOBALE
- Un produit à moins de 5 unités est marqué d'une alerte de rupture de stock en cours, une notification est envoyée aux 
gestionnaires de stock Le Djoor

- Lorsqu'une commande est annulée, les produits sont rapidement remis à la vente
- 02 moyens de paiement CARTE VISA ou CRINA-PAY (service de paiement, historique, Prévoir l'ajout d'un nouveau mode de 
paiement *penser au O de SOLID) 
- Listing des paniers non payés
- Listing des paiements avec filtre par type de paiement

## STACK

- Front-end : Ts / React 
- Back-end : Php / Laravel
