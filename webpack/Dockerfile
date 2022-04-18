FROM node:14

WORKDIR /my_webpack

RUN npm init -y
COPY package*.json ./
RUN npm i -D

CMD ["node", "app.js"]