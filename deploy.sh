#!/usr/bin/env bash

docker build ./ -t demo-asyncphp
docker run -p 8080:8080  -t demo-asyncphp
