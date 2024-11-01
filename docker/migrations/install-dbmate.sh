#!/bin/bash

set -e

os=$(uname -s)
arch=$(uname -m)


if [[ $arch = "aarch64" ]]
then
    curl -fsSL -o /usr/local/bin/dbmate https://github.com/amacneil/dbmate/releases/latest/download/dbmate-linux-arm64
else 
    curl -fsSL -o /usr/local/bin/dbmate https://github.com/amacneil/dbmate/releases/latest/download/dbmate-linux-amd64
fi
chmod +x /usr/local/bin/dbmate