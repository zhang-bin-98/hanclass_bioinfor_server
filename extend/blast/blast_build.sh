#!/usr/bin/bash

# dir=./extend/blast/db
# cd $dir
# {
#     echo "start: "
#     echo `date`
#     time makeblastdb -in coronavirida.fasta -dbtype nucl -out coronavirida.blastdb 
#     echo "finash: "
#     echo `date`
# } 2>&1 |
# tee make_coronavirida.blastdb.log

cd /opt/lampp/htdocs/students/202128010315003/tp5/extend/blast/test
blastn=/usr/bin/blastn
db=/opt/lampp/htdocs/students/202128010315003/tp5/extend/blast/db/coronavirida.blastdb
input=/opt/lampp/htdocs/students/202128010315003/tp5/extend/blast/test/test.txt
inpu_seq=ACCAATCTCTGATGAAGTCGATGCTACTCACTTTGGAACTTTTGGTGTAGCCGTAGAGGC

# https://www.ncbi.nlm.nih.gov/books/NBK279684/#appendices.Options_for_the_commandline_a
# cat $input |
echo $inpu_seq |
$blastn -db $db -outfmt 0
