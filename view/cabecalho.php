<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Marcelo Júnior">
        <meta name="description" content="Sistema de controle financeiro pessoal">
        <meta name="keywords" content="finanças, controle, dinheiro, sistema">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?=$titulo;?></title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <link rel="stylesheet" href="/css/material-icons.css">
        <link rel="stylesheet" href="/css/main.css">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-md navbar-dark bg-dark">
                <a class="navbar-brand mb-0 h1" href="/contas">Conta Contas</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <span class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Contas
                          </span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/contas">Listar</a>
                                <a class="dropdown-item" href="/contas/inserir">Inserir</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <h1>Conta Contas</h1>
        </header>
        <div class="center" id="loading">
                <img src="/img/spinner.gif" alt="Figura que representa que a página está carregando">
        </div>
        <main>
            <section>
                <h2><?=$titulo;?></h2>
