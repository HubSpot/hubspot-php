#!/bin/bash
if [ "${PHPSPEC}" != "false" ]; then
  vendor/bin/phpspec run --verbose
fi
