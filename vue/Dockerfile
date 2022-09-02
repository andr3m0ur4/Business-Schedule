FROM node:lts as build-stage

# instala um servidor http simples para servir conteúdo estático
RUN npm install -g http-server

# faz da pasta 'app' o diretório atual de trabalho
WORKDIR /var/www/html/app/

# copia os arquivos 'package.json' e 'package-lock.json' (se disponível)
COPY package*.json ./

# instala dependências do projeto
RUN npm install

# copia arquivos e pastas para o diretório atual de trabalho (pasta 'app')
COPY . .

# compila a aplicação de produção com minificação
RUN npm run build

# estágio de produção
# FROM nginx:stable as production-stage

# COPY --from=build-stage /var/www/html/app/dist /usr/share/nginx/html

EXPOSE 80
# CMD ["nginx", "-g", "daemon off;"]
CMD [ "http-server", "dist" ]
