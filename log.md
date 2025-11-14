scheduling build on Metal builder "builder-ozbnqy"
[snapshot] received sha256:8c920ee940e11df95b6afd20159a6800516b20cd8ffa34396bfd88a79284c6d3 md5:7059cfbc122ceeb3f5e32286f575af56
[snapshot] receiving snapshot, complete 16 MB [took 3.692932907s]
[snapshot] analyzing snapshot, complete 16 MB [took 258.662667ms]
[snapshot] uploading snapshot, complete 16 MB [took 340.167119ms]
scheduling build on Metal builder "builder-ozbnqy"
fetched snapshot sha256:8c920ee940e11df95b6afd20159a6800516b20cd8ffa34396bfd88a79284c6d3 (16 MB bytes)
[snapshot] fetching snapshot, complete 16 MB [took 538.651324ms]
[snapshot] unpacking archive, complete 49 MB [took 411.053702ms]
using build driver nixpacks-v1.39.0
 
╔══════════════════════════════ Nixpacks v1.39.0 ══════════════════════════════╗
║ setup      │ php82, php82Packages.composer, php82Extensions.mbstring,        ║
║            │ php82Extensions.pdo, php82Extensions.pdo_mysql,                 ║
║            │ php82Extensions.gd, php82Extensions.zip, php82Extensions.curl,  ║
║            │ php82Extensions.opcache, php82Extensions.redis, nginx, gettext  ║
║──────────────────────────────────────────────────────────────────────────────║
║ install    │ composer install --no-dev --optimize-autoloader --no-           ║
║            │ interaction                                                     ║
║──────────────────────────────────────────────────────────────────────────────║
║ build      │ mkdir -p storage/framework/{sessions,views,cache}               ║
║            │ mkdir -p storage/logs                                           ║
║            │ mkdir -p bootstrap/cache                                        ║
║            │ chmod -R 775 storage bootstrap/cache                            ║
║──────────────────────────────────────────────────────────────────────────────║
║ start      │ bash start.sh                                                   ║
╚══════════════════════════════════════════════════════════════════════════════╝
 
 
Saved output to:
  snapshot-target-unpack

internal
load build definition from Dockerfile
0ms

internal
load metadata for ghcr.io/railwayapp/nixpacks:ubuntu-1745885067
565ms

internal
load .dockerignore
0ms
SecretsUsedInArgOrEnv: Do not use ARG or ENV instructions for sensitive data (ARG "APP_KEY") (line 11)(https://docs.docker.com/go/dockerfile/rule/secrets-used-in-arg-or-env/)
 details: Sensitive data should not be used in the ARG or ENV commands
SecretsUsedInArgOrEnv: Do not use ARG or ENV instructions for sensitive data (ARG "DB_PASSWORD") (line 11)(https://docs.docker.com/go/dockerfile/rule/secrets-used-in-arg-or-env/)
 details: Sensitive data should not be used in the ARG or ENV commands
SecretsUsedInArgOrEnv: Do not use ARG or ENV instructions for sensitive data (ARG "JWT_SECRET") (line 11)(https://docs.docker.com/go/dockerfile/rule/secrets-used-in-arg-or-env/)
 details: Sensitive data should not be used in the ARG or ENV commands
SecretsUsedInArgOrEnv: Do not use ARG or ENV instructions for sensitive data (ENV "APP_KEY") (line 12)(https://docs.docker.com/go/dockerfile/rule/secrets-used-in-arg-or-env/)
 details: Sensitive data should not be used in the ARG or ENV commands
SecretsUsedInArgOrEnv: Do not use ARG or ENV instructions for sensitive data (ENV "DB_PASSWORD") (line 12)(https://docs.docker.com/go/dockerfile/rule/secrets-used-in-arg-or-env/)
 details: Sensitive data should not be used in the ARG or ENV commands
SecretsUsedInArgOrEnv: Do not use ARG or ENV instructions for sensitive data (ENV "JWT_SECRET") (line 12)(https://docs.docker.com/go/dockerfile/rule/secrets-used-in-arg-or-env/)
 details: Sensitive data should not be used in the ARG or ENV commands

[ 1/13] FROM ghcr.io/railwayapp/nixpacks:ubuntu-1745885067@sha256:d45c89d80e13d7ad0fd555b5130f22a866d9dd10e861f589932303ef2314c7de
9ms

internal
load build context
0ms

[ 2/13] WORKDIR /app/ cached
0ms

[ 3/13] COPY .nixpacks/nixpkgs-e24b4c09e963677b1beea49d411cd315a024ad3a.nix .nixpacks/nixpkgs-e24b4c09e963677b1beea49d411cd315a024ad3a.nix
209ms

[ 4/13] RUN nix-env -if .nixpacks/nixpkgs-e24b4c09e963677b1beea49d411cd315a024ad3a.nix && nix-collect-garbage -d
50s
19 store paths deleted, 235.33 MiB freed

[ 5/13] COPY .nixpacks/assets /assets/
217ms

[ 6/13] COPY . /app/.
435ms

[ 7/13] RUN  composer install --no-dev --optimize-autoloader --no-interaction
14s
Use the `composer fund` command to find out more!

[ 8/13] COPY . /app/.
1s

[ 9/13] RUN  mkdir -p storage/framework/{sessions,views,cache}
196ms

1
RUN  mkdir -p storage/logs
348ms

1
RUN  mkdir -p bootstrap/cache
202ms

1
RUN  chmod -R 775 storage bootstrap/cache
198ms

1
COPY . /app
1s

exporting to docker image format
6s
containerimage.descriptor: eyJtZWRpYVR5cGUiOiJhcHBsaWNhdGlvbi92bmQub2NpLmltYWdlLm1hbmlmZXN0LnYxK2pzb24iLCJkaWdlc3QiOiJzaGEyNTY6NmIzYWM3ZDA1NzI0YjAyZWQ3OGI2MGE2ZjZmM2RkOTc3ZmU2MDNhOTdmZWIzM2FiMTQ0MzMyMjhlNTUyMjA5YSIsInNpemUiOjMzMzEsImFubm90YXRpb25zIjp7Im9yZy5vcGVuY29udGFpbmVycy5pbWFnZS5jcmVhdGVkIjoiMjAyNS0xMS0xNFQwNTowOToxMloifSwicGxhdGZvcm0iOnsiYXJjaGl0ZWN0dXJlIjoiYW1kNjQiLCJvcyI6ImxpbnV4In19
containerimage.config.digest: sha256:a02145617f7ff8d25a7afad8b9df05c467045a14395fd81c31ddc940d2b89228
containerimage.digest: sha256:6b3ac7d05724b02ed78b60a6f6f3dd977fe603a97feb33ab14433228e552209a
image push progress: 404 MB/445 MB
image push progress: 445 MB/445 MB