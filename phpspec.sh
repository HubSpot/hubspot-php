#!/bin/bash
if [ "${PHPSPEC}" = "true" ]; then
  vendor/bin/phpspec run --verbose
fi
