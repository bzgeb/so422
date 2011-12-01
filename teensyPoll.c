#include <string.h>
#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
#include <fcntl.h>
#include <termios.h>

int main(int argc,char** argv)
{
    struct termios tio;
    int tty_fd;
    fd_set rdset;

    unsigned char * c = malloc(sizeof(char) * 4);

//    printf("Please start with %s /dev/ttyS1 (for example)\n",argv[0]);

    memset(&tio,0,sizeof(tio));
    tio.c_iflag=0;
    tio.c_oflag=0;
    tio.c_cflag=CS8|CREAD|CLOCAL;           // 8n1, see termios.h for more information
    tio.c_lflag=0;
    tio.c_cc[VMIN]=1;
    tio.c_cc[VTIME]=5;

    tty_fd=open(argv[1], O_RDWR | O_NONBLOCK);      
    cfsetospeed(&tio,B9600);            //  baud
    cfsetispeed(&tio,B9600);            //  baud

    tcsetattr(tty_fd,TCSANOW,&tio);

    write(tty_fd, argv[2], strlen(argv[2]));

    while(1)
    {
        if(read(tty_fd, c, 1)>0)// try to read a byte from the tty
        {
            printf("%d", *c);
            break;
        }
    } 
    close(tty_fd);

    return 0;
}
