FROM node:18

WORKDIR /usr/src/app

# Copie package.json et lock
COPY package.json package-lock.json* ./

# Installe les dépendances
RUN npm install

# Copie le reste des fichiers
COPY . .

EXPOSE 3005

CMD ["npm", "start"]
