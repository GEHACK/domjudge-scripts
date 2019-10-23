default:
	@echo "No default target available, run one of:"
	@echo
	@echo " - make domserver"
	@echo " - make assets"
	@echo " - make judgehost"

domserver judgehost assets: %: %.yml hosts $(wildcard common_tasks*.yml)
	ansible-playbook -i hosts $<

clean:
	rm -rf files/lib/vendor

.PHONY: default clean domserver assets judgehost
