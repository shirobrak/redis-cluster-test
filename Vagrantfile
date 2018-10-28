# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

  config.vm.box = "geerlingguy/centos7"
  config.vm.network "private_network", ip: "192.168.33.10"
  config.ssh.forward_agent = true

  config.vm.provision "ansible_local" do |ansible|
    ansible.playbook = "provisioning/site.yml"
  end

end
