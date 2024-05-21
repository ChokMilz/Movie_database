import mysql.connector
import os

# Create a connection to the database
cnx = mysql.connector.connect(
    user="root", password="", host="localhost", allow_local_infile=True
)

# Create a cursor object using the cursor() method
cursor = cnx.cursor()

with open("scripts/creation_script.sql", "r") as file:
    sql = file.read()


def execute_sql(sql, cursor):
    for statement in sql.split(";"):
        if statement.strip() != "":
            cursor.execute(statement)
            cnx.commit()


execute_sql(sql, cursor)

base_path = os.path.dirname(os.path.abspath(__file__))

sql = sql.replace(
    "csv/Country-table.csv", os.path.join(base_path, "csv/Country-table.csv")
)
sql = sql.replace("csv/Movie-table.csv", os.path.join(base_path, "csv/Movie-table.csv"))
sql = sql.replace(
    "csv/Artist-table.csv", os.path.join(base_path, "csv/Artist-table.csv")
)
sql = sql.replace("csv/Role-table.csv", os.path.join(base_path, "csv/Role-table.csv"))
sql = sql.replace(
    "csv/Internet-user-table.csv",
    os.path.join(base_path, "csv/Internet-user-table.csv"),
)


with open("scripts/import_script.sql", "r") as file:
    sql = file.read()

execute_sql(sql, cursor)

with open("scripts/sanitize_script.sql", "r") as file:
    sql = file.read()

execute_sql(sql, cursor)

cursor.close()
cnx.close()
