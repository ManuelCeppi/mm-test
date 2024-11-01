#!/bin/bash

# exits if a command returns a non-zero status
set -e

echo "######################"
echo "ENTRYPOINT PWA"
echo "######################"

# setting as superuser
su node

# installing node modules
npm install

# serving the spa
npm run dev