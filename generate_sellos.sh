#!/bin/sh

SELLO=$1
PASSWORD=$2
SELLOS_DIR=sellos

openssl pkcs8 -inform DER -in ${SELLOS_DIR}/${SELLO}.key -out ${SELLOS_DIR}/${SELLO}.key.pem -passin pass:${PASSWORD}
#openssl rsa -in ${SELLOS_DIR}/${SELLO}.key.tmp.pem -des3 -out ${SELLOS_DIR}/${SELLO}.key.pem

openssl x509 -inform DER -outform PEM -in ${SELLOS_DIR}/${SELLO}.cer -pubkey > ${SELLOS_DIR}/${SELLO}.cer.pem

openssl x509 -in ${SELLOS_DIR}/${SELLO}.cer.pem -issuer -noout
openssl x509 -in ${SELLOS_DIR}/${SELLO}.cer.pem -startdate -enddate -noout
openssl x509 -in ${SELLOS_DIR}/${SELLO}.cer.pem -subject -noout
openssl x509 -in ${SELLOS_DIR}/${SELLO}.cer.pem -serial -noout
