import { Request, Response } from "express";
import axios from 'axios';

const express = require('express');
const app = express();

app.use(express.json());

app.get('/api/produtos', async (req:Request, res:Response) => {
    try {
        const response = await axios.get('https://fakestoreapi.com/products');

        const produtos = response.data;

        res.json(produtos);
    } catch (error) {
        console.error('Erro ao retornar lista de produtos', error);
        res.status(500).json({error: 'Ocorreu um erro ao obter a lista de produtos'});
    }
});

app.post('/api/compras/:id',
    async (req: Request, res: Response) => {
        try {
            const idProduto = req.params.id;
            const response =
                await axios.get('https://fakestoreapi.com/products/' + idProduto);
            const jsonData = response.data;

            jsonData.name = req.body.name;
            jsonData.address = req.body.address;

            await axios.post('http://nginx/intencao/compra', jsonData)
                .then(response => {
                    console.log('Resposta Symfony', response.data);
                })
                .catch(error => {
                    console.log('Erro requisição', error)
                });

            res.json({message: 'JSON enviado com sucesso para o endpoint de destino'});
        } catch (error) {
            console.error('Erro ao gerar nova intenção de compra', error);
            res.status(500).json({error: 'Ocorreu um erro ao gerar nova intenção de compra'});
        }
    });

app.listen(3000, () => {
    console.log('Servidor iniciado na porta 3000');
});
