import {MessageService} from 'primeng/api';
import {Injectable} from '@angular/core';

@Injectable()
export class CustomMessageService {
  constructor(private readonly messageService: MessageService) {
  }

  public pushSuccessMessage(title: string, content: string): void {
    this.messageService.add({severity: 'success', summary: title, detail: content});
  }

  public pushErrorMessage(title: string, content: string): void {
    this.messageService.add({severity: 'error', summary: title, detail: content});
  }

  public pushWarningMessage(title: string, content: string): void {
    this.messageService.add({severity: 'warn', summary: title, detail: content});
  }

  public pushInfoMessage(title: string, content: string): void {
    this.messageService.add({severity: 'info', summary: title, detail: content});
  }
}
