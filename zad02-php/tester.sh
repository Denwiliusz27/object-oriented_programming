echo "~~~~~~~~~~~~~~~~~~~ GET ALL ~~~~~~~~~~~~~~~~~~~~~~"
curl -l http://127.0.0.1:8000/product/getAll # gets all products

echo "~~~~~~~~~~~~~~~~~~~ GET ID=1 ~~~~~~~~~~~~~~~~~~~~~~"
curl -l http://127.0.0.1:8000/product/1/get # get article with id=1

echo "~~~~~~~~~~~~~~~~~~~ DELETE ID=1 ~~~~~~~~~~~~~~~~~~~~~~"
curl -l http://127.0.0.1:8000/product/1/delete  # delete article with id=1

echo "~~~~~~~~~~~~~~~~~~~ ADD ~~~~~~~~~~~~~~~~~~~~~~"
curl -X POST http://127.0.0.1:8000/product/add
   -H 'Content-Type: application/json'
   -d '{"name":"Lalka","author":"Boleslaw Prus","price":"34","amount":"20","description":"Book about love"}'
