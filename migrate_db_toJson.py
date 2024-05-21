import json
import mysql.connector
from bson import ObjectId

# Connect to MySQL
db = mysql.connector.connect(
    user="root", password="", host="localhost", allow_local_infile=True, database="movies_database"
)

cursor = db.cursor(dictionary=True)

# Extract Internet_user and Score_movie data
# cursor.execute("""
#     SELECT
#         iu.email,
#         iu.surname,
#         iu.name,
#         iu.region,
#         sm.movieId,
#         sm.score
#     FROM
#         Internet_user iu
#     LEFT JOIN
#         Score_movie sm ON iu.email = sm.email;
# """)

# users_data = cursor.fetchall()

# # Denormalize user data
# users = {}
# for record in users_data:
#     email = record['email']
#     if email not in users:
#         users[email] = {
#             "_id": {"$oid": str(ObjectId())},
#             "email": email,
#             "surname": record['surname'],
#             "name": record['name'],
#             "region": record['region'].strip(),
#             "Score_movie": {}
#         }
#     if record['movieId'] is not None:
#         users[email]["Score_movie"][record['movieId']] = record['score']

# # Convert to list for JSON array format
# users_list = list(users.values())

# # Save to JSON file
# with open('json/Internet__user.json', 'w') as f:
#     json.dump(users_list, f, indent=4)

# cursor.close()
# db.close()

# Extract Movie, Country, and Role data
cursor.execute("""
    SELECT
        m.movieId,
        m.title,
        m.year,
        m.genre,
        m.summary,
        c.code AS country_code,
        c.name AS country_name,
        c.language AS country_language,
        m.producerId,
        p.surname AS producer_surname,
        p.name AS producer_name,
        p.DOB AS producer_DOB,
        r.roleName,
        a.artistId,
        a.surname AS artist_surname,
        a.name AS artist_name,
        a.DOB AS artist_DOB,
        sm.score
    FROM
        Movie m
    LEFT JOIN
        Country c ON m.countryCode = c.code
    LEFT JOIN
        Role r ON m.movieId = r.movieId
    LEFT JOIN
        Artist a ON r.actorId = a.artistId
    LEFT JOIN
        Artist p ON m.producerId = p.artistId
    LEFT JOIN
        Score_movie sm ON m.movieId = sm.movieId;
""")

movies_data = cursor.fetchall()

# Denormalize movie data
movies = {}
for record in movies_data:
    movie_id = record['movieId']
    if movie_id not in movies:
        movies[movie_id] = {
            "_id": {"$oid": str(ObjectId())},
            "movieId": {"$numberInt": str(movie_id)},
            "title": record['title'],
            "year": {"$numberInt": str(record['year'])},
            "genre": record['genre'],
            "summary": record['summary'],
            "country": {
                "code": record['country_code'],
                "name": record['country_name'],
                "language": record['country_language']
            },
            "producer": {
                "producerId": {"$numberInt": str(record['producerId'])},
                "surname": record['producer_surname'],
                "name": record['producer_name'],
                "DOB": {"$numberInt": str(record['producer_DOB'])}
            },
            "role": [],
            "Score_movie": {}
        }
    if record['artistId'] is not None:
        role = {
            "roleName": record['roleName'],
            "artist": {
                "artistId": {"$numberInt": str(record['artistId'])},
                "surname": record['artist_surname'],
                "name": record['artist_name'],
                "DOB": {"$numberInt": str(record['artist_DOB'])}
            }
        }
        movies[movie_id]["role"].append(role)
    if record['score'] is not None:
        movies[movie_id]["Score_movie"]["email"] = record['score']

# Save to JSON file
with open('json/Movie_.json', 'w') as f:
    for movie in movies.values():
        json.dump(movie, f, indent=4)
        f.write(",\n")

cursor.close()
db.close()