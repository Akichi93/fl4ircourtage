import csv
import random

# Définition des types de civilite
civilites = ['M.', 'Mme']

# Définition des professions possibles
professions = ['Ingénieur', 'Médecin', 'Avocat', 'Enseignante', 'Architecte', 'Artiste', 'Scientifique', 'Journaliste', 'Pompier', 'Informaticien']

# Générateur de données fictives
def generate_data():
    civilite = random.choice(civilites)
    nom_client = 'Nom' + str(random.randint(1, 1000))
    postal_client = str(random.randint(10000, 99999))
    adresse_client = str(random.randint(1, 1000)) + ' Rue Principale'
    tel_client = '0' + str(random.randint(100000000, 999999999))
    profession_client = random.choice(professions)
    fax_client = '0' + str(random.randint(100000000, 999999999))
    email_client = nom_client.lower() + '@example.com'
    numero_client = 'CL' + str(random.randint(1, 1000))

    return [civilite, nom_client, postal_client, adresse_client, tel_client, profession_client, fax_client, email_client, numero_client]

# Nombre de lignes souhaité
nombre_de_lignes = 20000

# Nom du fichier CSV
nom_fichier = 'clients.csv'

# Génération des données
donnees = [['civilite', 'nom_client', 'postal_client', 'adresse_client', 'tel_client', 'profession_client', 'fax_client', 'email_client', 'numero_client']]

for _ in range(nombre_de_lignes):
    donnees.append(generate_data())

# Écriture des données dans le fichier CSV
with open(nom_fichier, 'w', newline='') as fichier_csv:
    writer = csv.writer(fichier_csv)
    writer.writerows(donnees)

print(f"Le fichier {nom_fichier} a été généré avec succès.")
