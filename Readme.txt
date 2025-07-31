Déploiement avec Kubernetes
Prérequis
Kubernetes installé et configuré (minikube, kind, ou cluster distant)

kubectl configuré pour interagir avec le cluster

Le code source du projet cloné localement

Fichiers Kubernetes inclus
k8s/php-deployment.yaml : déploiement PHP (2 replicas, image officielle, volume code)

k8s/node-deployment.yaml : déploiement Node.js (avec Dockerfile pour build)

k8s/postgres-deployment.yaml : déploiement PostgreSQL (avec volume persistant)

k8s/services.yaml : services pour exposer les pods (NodePort pour Node et PHP, ClusterIP pour PostgreSQL)

Commandes pour lancer l’application sur Kubernetes
Depuis la racine du projet :


kubectl apply -f k8s/postgres-deployment.yaml
kubectl apply -f k8s/php-deployment.yaml
kubectl apply -f k8s/node-deployment.yaml
kubectl apply -f k8s/services.yaml
Vérifie que les pods sont démarrés :


kubectl get pods -w
Tu dois voir les pods php-deployment, node-deployment et postgres-deployment en état Running.

Accéder à l’application
Vote PHP : http://localhost:8080

Résultats Node.js : http://localhost:3005

(Les ports sont ceux exposés par les services Kubernetes en NodePort, adaptés à ta config)

Notes
Le code PHP est monté via un volume hostPath dans le déploiement PHP (adapter le chemin en fonction de ta machine)

L’image PHP utilise directement l’image officielle php:8.2-apache, sans Dockerfile

L’image Node est buildée localement via Dockerfile (penser à docker build ou intégrer un build dans le pipeline Kubernetes)

PostgreSQL utilise un volume persistant pour garder les données entre redémarrages


Comment accéder depuis ta machine ?
Pour PHP, si le nodePort est 30929, tu accèdes à :
http://localhost:30929

Pour Node.js, si le nodePort est 30168, tu accèdes à :
http://localhost:30168


| Environnement        | URL d’accès                                             | Port exposé sur ta machine                 |
| -------------------- | ------------------------------------------------------- | ------------------------------------------ |
| Docker Compose local | [http://localhost:8080](http://localhost:8080) (PHP)    | Port 8080 (direct mapping)                 |
| Kubernetes           | [http://localhost:30929](http://localhost:30929) (PHP)  | Port NodePort 30929 configuré dans Service |
| Docker Compose local | [http://localhost:3005](http://localhost:3005) (Node)   | Port 3005 (direct mapping)                 |
| Kubernetes           | [http://localhost:30168](http://localhost:30168) (Node) | Port NodePort 30168 configuré dans Service |
