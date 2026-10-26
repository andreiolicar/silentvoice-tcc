<?php

return [
    'required' => 'O campo :attribute é obrigatório.',
    'string' => 'O campo :attribute deve ser um texto.',
    'email' => 'Informe um e-mail válido.',
    'lowercase' => 'O campo :attribute deve usar letras minúsculas.',
    'unique' => 'Este :attribute já está cadastrado.',
    'in' => 'Selecione uma opção válida para :attribute.',
    'confirmed' => 'A confirmação de :attribute não confere.',
    'current_password' => 'A senha atual está incorreta.',
    'min' => ['string' => 'O campo :attribute deve ter pelo menos :min caracteres.'],
    'max' => ['string' => 'O campo :attribute deve ter no máximo :max caracteres.'],
    'attributes' => [
        'name' => 'nome', 'email' => 'e-mail', 'password' => 'senha',
        'current_password' => 'senha atual', 'interest_type' => 'tipo de interesse',
    ],
];
