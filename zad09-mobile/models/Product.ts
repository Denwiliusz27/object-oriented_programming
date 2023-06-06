export interface Product {
    id: Number;
    name: string;
    price: Number;
    cathegory_id: Number;
}

export const products: Product[] = [
    {
        id: 1,
        name: "Kubuś puchatek",
        price: 23,
        cathegory_id: 3
    },
    {
        id: 2,
        name: "Reksio",
        price: 10,
        cathegory_id: 3
    },
    {
        id: 3,
        name: "Dzieci z Bullerbyn",
        price: 15,
        cathegory_id: 3
    },
    {
        id: 4,
        name: "To",
        price: 25,
        cathegory_id: 4
    },
    {
        id: 5,
        name: "Sugar Man",
        price: 22,
        cathegory_id: 1
    },
    {
        id: 6,
        name: "Sól ziemi",
        price: 18,
        cathegory_id: 1
    },
    {
        id: 7,
        name: "Incepcja",
        price: 30,
        cathegory_id: 2
    },
    {
        id: 8,
        name: "Milczenie owiec",
        price: 33,
        cathegory_id: 2
    },
    {
        id: 9,
        name: "Siedem",
        price: 28,
        cathegory_id: 2
    },
    {
        id: 10,
        name: "Spider Man",
        price: 30,
        cathegory_id: 3
    },
    {
        id: 11,
        name: "Resident Evil",
        price: 23,
        cathegory_id: 4
    },
];