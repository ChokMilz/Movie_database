# Connect to MongoDB (update the connection string as needed)
import subprocess

# command = [
#     "mongoimport",
#     "--db",
#     "movies_database",
#     "--collection",
#     "internet_user",
#     "--file",
#     r"C:\xampp\htdocs\movie_database\json\Internet__user.json",
#     "--jsonArray",
# ]

# subprocess.run(command, check=True)

# print("Internet User Documents inserted successfully.")

command = [
    "mongoimport",
    "--db",
    "movies_database",
    "--collection",
    "movie",
    "--file",
    r"C:\xampp\htdocs\movie_database\json\Movies.json",
    "--jsonArray",
]

subprocess.run(command, check=True)
