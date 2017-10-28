#!/bin/bash
git push origin master
ssh -q root@milansuk.cz < deploy_server.sh
