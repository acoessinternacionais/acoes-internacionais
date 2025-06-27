#!/bin/bash

# 1. Atualiza o repositório local
cd /caminho/para/seu/projeto # Substitua pelo caminho real

git pull origin main

# 2. Faz o build (se precisar)
# Ex: npm run build

# 3. Faz deploy para o Render (se configurado via GitHub)
echo "Deploy concluído automaticamente."

# Obs: Para funcionar automaticamente:
# - O projeto deve estar vinculado ao GitHub
# - O Render precisa estar conectado ao repositório
# - Habilitar "Auto Deploy" no Render
