FROM centos:7

# Fix CentOS 7 EOL mirror issues
RUN sed -i 's/mirrorlist/#mirrorlist/g' /etc/yum.repos.d/CentOS-* && \
  sed -i 's|#baseurl=http://mirror.centos.org|baseurl=http://vault.centos.org|g' /etc/yum.repos.d/CentOS-*

ENV TERM xterm-256color
ENV container docker
WORKDIR /tmp

# Combined yum operations to reduce layers
RUN yum clean all && \
  yum update -y && \
  yum install -y \
  vim wget telnet bind-utils net-tools lsof pkgconfig libtool \
  gcc gcc-c++ make openssl openssl-devel tcl tcl-devel \
  pcre pcre-devel libcap libcap-devel flex hwloc hwloc-devel \
  lua ncurses ncurses-devel curl libcurl-devel autoconf automake \
  libunwind libunwind-devel bzip2 expat-devel && \
  yum clean all

# Download and build Traffic Server with cleanup in one layer
RUN wget http://archive.apache.org/dist/trafficserver/trafficserver-7.1.1.tar.bz2 && \
  tar -xvf trafficserver-7.1.1.tar.bz2 && \
  cd trafficserver-7.1.1 && \
  autoreconf -if && \
  ./configure --prefix=/opt/ts && \
  make -j4 && \
  make check && \
  make install && \
  make distclean && \
  cd .. && \
  rm -rf trafficserver-7.1.1*

# Create symlinks
RUN ln -s /opt/ts/etc/trafficserver /etc/trafficserver || /bin/true && \
  ln -s /opt/ts/bin/trafficserver /etc/init.d/trafficserver || /bin/true

# Configure reverse proxy
RUN sed -i 's/CONFIG proxy.config.reverse_proxy.enabled INT 0/CONFIG proxy.config.reverse_proxy.enabled INT 1/g' /etc/trafficserver/records.config

ADD ./docker/ats7/remap.config /etc/trafficserver/remap.config

EXPOSE 8080

ENTRYPOINT ["/opt/ts/bin/traffic_cop"]