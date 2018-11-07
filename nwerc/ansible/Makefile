default:
	@echo "No default target available, run one of:"
	@echo
	@echo " - make domserver"
	@echo " - make judgehost"

domserver judgehost: %: %.yml hosts $(wildcard common_tasks*.yml)
	ansible-playbook -i hosts $<

clean:
	rm -rf files/lib/vendor

.PHONY: default clean domserver judgehost
