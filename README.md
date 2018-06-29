# cli-compress

Module cli tools untuk mengkompresi file general.

## Instalasi

Jalankan perintah berikut dimana tools cli di-install:

```bash
mim app install cli-compress
```

## Penggunaan

```bash
mim compress [all|gzip|brotli|webp] [file[ ...]]

# kompres gzip semua file di folder ini
mim compress gzip ./*

# kompress semua gambar dengan webp di folder ini
mim compress webp ./*
```