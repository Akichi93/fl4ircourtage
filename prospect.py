import csv
import random

# Définition des types de civilite
civilites = ['M.', 'Mme', 'Dr.', 'Pr.', 'Prof.']

# Définition des professions possibles
professions = ['Ingénieur', 'Médecin', 'Avocat', 'Enseignant', 'Architecte', 'Artiste', 'Scientifique', 'Journaliste', 'Pompier', 'Informaticien',
               'Pharmacien', 'Chercheur', 'Écrivain', 'Entrepreneur', 'Designer', 'Psychologue', 'Musicien', 'Électricien', 'Plombier', 'Chef']

# Générateur de données fictives
def generate_data():
    civilite = random.choice(civilites)
    nom_prospect = 'Nom' + str(random.randint(1, 1000))
    postal_prospect = str(random.randint(10000, 99999))
    adresse_prospect = str(random.randint(1, 1000)) + ' Rue Principale'
    tel_prospect = '0' + str(random.randint(100000000, 999999999))
    profession_prospect = random.choice(professions)
    fax_prospect = '0' + str(random.randint(100000000, 999999999))
    email_prospect = nom_prospect.lower() + '@example.com'

    return [civilite, nom_prospect, postal_prospect, adresse_prospect, tel_prospect, profession_prospect, fax_prospect, email_prospect]

# Nombre de lignes souhaité
nombre_de_lignes = 20000

# Nom du fichier CSV
nom_fichier = 'prospect.csv'

# Génération des données
donnees = [['civilite', 'nom_prospect', 'postal_prospect', 'adresse_prospect', 'tel_prospect', 'profession_prospect', 'fax_prospect', 'email_prospect']]

for _ in range(nombre_de_lignes):
    donnees.append(generate_data())

# Écriture des données dans le fichier CSV
with open(nom_fichier, 'w', newline='') as fichier_csv:
    writer = csv.writer(fichier_csv)
    writer.writerows(donnees)

print(f"Le fichier {nom_fichier} a été généré avec succès.")
