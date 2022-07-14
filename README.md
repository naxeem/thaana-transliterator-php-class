# Thaana Transliterator

Thaana text to Latin transliterator.

This was initially available at naxeem/thaana-transliterator.

### Usage

```php
require_once './class-thaana-transliterator.php';

$transliterator = new Thaana_Transliterator;

echo $transliterator->transliterate("ސަލާމް"); // Salaam

```

### Custom translations

```php

$transliterator = new Thaana_Transliterator;

$custom_translations = array(
  'އައިއޯއެސް' => 'IOS',
  'އެޕްސް' => 'apps',
  'އެންޑްރޮއިޑް' => 'android'
);

$transliterator->addTranslations($custom_translations);

echo $transliterator->transliterate("އެންޑްރޮއިޑް ފޯނުން އައިއޯއެސް އެޕްސް މިހާރު ބޭނުންކުރެވޭ."); // Android foanun ios apps mihaaru beynunkurevey.

```

### Other versions

#### Composer: [github.com/naxeem/thaana-transliterator](https://github.com/naxeem/thaana-transliterator)

#### NPM: [github.com/mapmeld/thaana-transliterator](https://github.com/mapmeld/thaana-transliterator) by [@mapmeld](https://github.com/mapmeld)

#### Javascript: [github.com/naxeem/thaana-transliterator-js](https://github.com/naxeem/thaana-transliterator-js)

## Use Online / Demo

[Online Thaana Transliterator](https://www.naxeem.com/lab/thaana-transliterator/)

## Input/Output

### Input

ހުރިހާ އިންސާނުން ވެސް އުފަންވަނީ، ދަރަޖައާއި ޙައްޤުތަކުގައި މިނިވަންކަމާއި ހަމަހަމަކަން ލިބިގެންވާ ބައެއްގެ ގޮތުގައެވެ. އެމީހުންނަށް ހެޔޮވިސްނުމާއި، ހެޔޮ ބުއްދީގެ ބާރު ލިބިގެންވެއެވެ. އަދި އެމީހުން އެކަކު އަނެކަކާ މެދު މުޢާމަލާތް ކުރަންވަނީ، އުޚުއްވަތްތެރި ކަމުގެ ރޫޙެއްގައެވެ.

### Output

Hurihaa insaanun ves ufanvanee, dharajaaai hahquthakugai minivankamaai hamahamakan libigenvaa baehge gothugaeve. Emeehunnah heyovisnumaai, heyo buhdheege baaru libigenveeve. Adhi emeehun ekaku anekakaa medhu muaamalaai kuranvanee, ukhuhvaitheri kamuge roohehgaeve.

## Contributing

Anyone is welcome to improve this.