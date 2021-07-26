Hi,
This is a small blog to practice PHP,
I used Wamp to create the database,
there are two tables : billets and commentaires.

Here is the structure:

billets: 
-id Int(11), Auto increment
-titre, VARCHAR(255)
-contenu, text
-date_creation, datetime, Current time stamp

commentaires:
-id Int(11), Auto increment
-id_billet, INT(11)
-auteur, VARCHAR(255)
-commentaire, text
-date_commentaire, datetime, Current time stamp
