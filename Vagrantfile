# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|
  config.vm.box = "centos-6.5"

  config.vm.provision "ansible" do |ansible|
     ansible.playbook = "provisioning/playbook.yml"
     ansible.inventory_file = "provisioning/ansible_hosts"
  end

  config.vm.network :private_network, ip: "192.168.33.100"
end
