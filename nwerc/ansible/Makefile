default:
	@echo "No default target available, run one of:"
	@echo
	@echo " - make domserver"
	@echo " - make assets"
	@echo " - make judgehost"

EXECDIRS=$(shell find files/compile-scripts -mindepth 1 -maxdepth 1 -type d)
ZIPFILES=$(EXECDIRS:=.zip)

# Use secondary expansion to use stem $* in dependencies:
.SECONDEXPANSION:
$(ZIPFILES): %.zip: $$(wildcard $$*/*)
	@rm -f $@
	zip -qjr $@ $*

domserver judgehost assets: %: %.yml hosts $(wildcard common_tasks*.yml) $(ZIPFILES)
	ansible-playbook -i hosts $<

clean:
	rm -rf files/lib/vendor

.PHONY: default clean domserver assets judgehost
