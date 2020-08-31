# cli-compress

Module cli tools untuk mengkompresi file general.

## Instalasi

Jalankan perintah berikut dimana tools cli di-install:

```bash
mim app install cli-compress
```

## Penggunaan

```bash
mim compress (all|gzip|brotli|webp|jp2) (file[ ...])

# kompres gzip semua file di folder ini
mim compress gzip ./*

# kompress semua file png,gif di folder ini menjadi webp
mim compress webp ./*

# kompress semua file jpg di folder ini menjadi jp2
mim compress jp2 ./*
```