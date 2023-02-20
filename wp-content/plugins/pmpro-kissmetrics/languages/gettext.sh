#---------------------------
# This script generates a new pmpro-kissmetrics.pot file for use in translations.
# To generate a new pmpro-kissmetrics.pot, cd to the main /pmpro-kissmetrics/ directory,
# then execute `languages/gettext.sh` from the command line.
# then fix the header info (helps to have the old pmpro.pot open before running script above)
# then execute `cp languages/pmpro-kissmetrics.pot languages/pmpro-kissmetrics.po` to copy the .pot to .po
# then execute `msgfmt languages/pmpro-kissmetrics.po --output-file languages/pmpro-kissmetrics.mo` to generate the .mo
#---------------------------
echo "Updating pmpro-kissmetrics.pot... "
xgettext -j -o languages/pmpro-kissmetrics.pot \
--default-domain=pmpro-kissmetrics \
--language=PHP \
--keyword=_ \
--keyword=__ \
--keyword=_e \
--keyword=_ex \
--keyword=_n \
--keyword=_x \
--sort-by-file \
--package-version=1.0 \
--msgid-bugs-address="info@spaidmembershipspro.com" \
$(find . -name "*.php")
echo "Done!"
