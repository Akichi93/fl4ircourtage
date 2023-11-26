import csv
import random
import string

# Fonction pour générer une chaîne aléatoire
def generate_random_string(length):
    letters = string.ascii_letters
    return ''.join(random.choice(letters) for i in range(length))

# Fonction pour générer une adresse e-mail aléatoire
def generate_random_email():
    username = generate_random_string(8)
    domain = generate_random_string(5)
    return f"{username}@{domain}.com"

# Générer 1000 lignes de données
data = []
for _ in range(1000):
    row = {
        'nom_apporteur': generate_random_string(8),
        'email_apporteur': generate_random_email(),
        'adresse_apporteur': generate_random_string(15),
        'contact_apporteur': ''.join(random.choices(string.digits, k=10)),
        'code_apporteur': generate_random_string(5),
        'code_postal': ''.join(random.choices(string.digits, k=5)),
    }
    data.append(row)

# Écrire les données dans un fichier CSV
csv_file_path = 'apporteurs.csv'
with open(csv_file_path, 'w', newline='') as csv_file:
    fieldnames = ['nom_apporteur', 'email_apporteur', 'adresse_apporteur', 'contact_apporteur', 'code_apporteur', 'code_postal']
    writer = csv.DictWriter(csv_file, fieldnames=fieldnames)

    # Écrire l'en-tête
    writer.writeheader()

    # Écrire les données
    writer.writerows(data)

print(f"Le fichier CSV a été généré avec succès: {csv_file_path}")
