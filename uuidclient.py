import uuid
import json

# Your list of dictionaries
branche_records = [
    {'id_branche': 1, 'uuid': '', 'nom_branche': 'AUTOMOBILE', 'id_entreprise': '1', 'created_at': None, 'updated_at': None},
    {'id_branche': 2, 'uuid': '', 'nom_branche': 'MOTO', 'id_entreprise': '1', 'created_at': None, 'updated_at': None},
     {'id_branche' : 3, 'uuid' : '', 'nom_branche' : 'RC DIVERSES', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 4, 'uuid' : '', 'nom_branche' : 'RC EXPLOITATION', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 5, 'uuid' : '', 'nom_branche' : 'RC ENTREPRISE', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 6, 'uuid' : '', 'nom_branche' : 'RC ASSOCIATION SPORTIVE', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 7, 'uuid' : '', 'nom_branche' : 'RC PROFESSIONNELLE', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 8, 'uuid' : '', 'nom_branche' : 'TRANSPORT', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 9, 'uuid' : '', 'nom_branche' : 'RC PLAISANCE', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 10, 'uuid' : '', 'nom_branche' : 'MULTIRISQUE PLAISANCE', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 11, 'uuid' : '', 'nom_branche' : 'MARCHANDISES TRANSPORTEES', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 12, 'uuid' : '', 'nom_branche' : 'CORPS FLUVIAUX', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 13, 'uuid' : '', 'nom_branche' : 'MALADIE GROUPE', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 14, 'uuid' : '', 'nom_branche' : 'MALADIE PARTICULIER', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 15, 'uuid' : '', 'nom_branche' : 'ASSISTANCE', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 16, 'uuid' : '', 'nom_branche' : 'TOUS RISQUES SAUF', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 17, 'uuid' : '', 'nom_branche' : 'GLOBALES DOMMAGES', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 18, 'uuid' : '', 'nom_branche' : 'MULTIRISQUE IMMEUBLE', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 19, 'uuid' : '', 'nom_branche' : 'MULTIRISQUE HABITATION', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 20, 'uuid' : '', 'nom_branche' : 'MULTIRISQUE PROFESSIONELLE', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 21, 'uuid' : '', 'nom_branche' : 'MULTIRISQUE BUREAUX', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 22, 'uuid' : '', 'nom_branche' : 'TOUS RISQUE CHANTIER', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 23, 'uuid' : '', 'nom_branche' : 'RC DECENNALE', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 24, 'uuid' : '', 'nom_branche' : 'TOUS RISQUE MATERIELS', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 25, 'uuid' : '', 'nom_branche' : 'ENGINS DE CHANTIERS', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
            {'id_branche' : 26, 'uuid' : '', 'nom_branche' : 'BRIS DE MACHINES', 'id_entreprise' : '1', 'created_at' : None, 'updated_at' : None},
   
]

# Function to generate UUID
def generate_uuid():
    return str(uuid.uuid4())

# Add UUID to each branch record
for branch in branche_records:
    branch['uuid'] = generate_uuid()

# Now branche_records contains UUIDs for each branch record
    
    # Specify the file path
file_path = 'branche_records_with_uuids.json'

# Write the updated data to a JSON file
with open(file_path, 'w') as file:
    json.dump(branche_records, file, indent=2)

print(f'Data with UUIDs has been written to {file_path}')
print(branche_records)
