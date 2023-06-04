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
];