echo "~~~~~~~~~~~~~~~~~~~ GET ALL ~~~~~~~~~~~~~~~~~~~~~~"
curl -L http://127.0.0.1:8000/products/getAll # gets all products
echo

echo "~~~~~~~~~~~~~~~~~~~ GET ID=2 ~~~~~~~~~~~~~~~~~~~~~~"
curl -l http://127.0.0.1:8000/products/get/2 # get article with id=2
echo

echo "~~~~~~~~~~~~~~~~~~~ ADD ~~~~~~~~~~~~~~~~~~~~~~"
curl -X POST http://127.0.0.1:8000/products/add \
   -H 'Content-Type: application/json' \
   -d '{"name":"Lalka","author":"Boleslaw Prus","price":"34","amount":"20","description":"Book about love"}'
echo

echo "~~~~~~~~~~~~~~~~~~~ UPDATE ~~~~~~~~~~~~~~~~~~~~~~"
curl -X PUT http://127.0.0.1:8000/products/update/6 \
   -H 'Content-Type: application/json' \
   -d '{"name":"Dziady","author":"Adam Mickiewicz","price":"40","amount":"20","description":"Book for classes"}'
echo

echo "~~~~~~~~~~~~~~~~~~~ DELETE ID=11 ~~~~~~~~~~~~~~~~~~~~~~"
curl -X DELETE http://127.0.0.1:8000/products/delete/11  # delete article with id=11
echo
