default:
	@echo "No default target available, run one of:"
	@echo
	@echo " - make domserver"
	@echo " - make judgehost"
	@echo " - make reboot-judgehost"

domserver judgehost: %: %.yml hosts $(wildcard common_tasks*.yml)
	ansible-playbook -i hosts $<

reboot-judgehost:
	ansible -i hosts judgehost -a "reboot"

clean:
	rm -rf files/lib/vendor

.PHONY: default clean domserver judgehost
