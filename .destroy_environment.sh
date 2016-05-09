#!/bin/bash
if [ -e .git ] ; then
    rm -rf *
    rm .apache.conf.base .env .env.example .gitattributes .gitignore .install.sh .destroy_environment.sh
fi
