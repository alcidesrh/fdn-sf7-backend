#!/bin/bash
# Detect os codename
codename=$(awk '/UBUNTU_CODENAME=/' /etc/os-release | sed 's/UBUNTU_CODENAME=//' | sed 's/[.]0/./')

# Disable all the external repos
cd /etc/apt/sources.list.d && sudo bash -c 'for i in *.list; do mv ${i} ${i}.disabled; done' && cd /tmp

# Replace sources.list  
text="deb http://archive.ubuntu.com/ubuntu/ $codename main universe restricted multiverse
deb-src http://archive.ubuntu.com/ubuntu/ $codename main universe restricted multiverse
deb http://security.ubuntu.com/ubuntu $codename-security main universe restricted multiverse
deb-src http://security.ubuntu.com/ubuntu $codename-security main universe restricted multiverse
deb http://archive.ubuntu.com/ubuntu/ $codename-updates main universe restricted multiverse
deb-src http://archive.ubuntu.com/ubuntu/ $codename-updates main universe restricted multiverse"

sudo echo "$text" | sudo tee /etc/apt/sources.list

# Start upgrade
sudo apt update
sudo apt install -f -y
sudo apt upgrade -y
sudo apt dist-upgrade -y
sudo apt autoremove --purge -y
