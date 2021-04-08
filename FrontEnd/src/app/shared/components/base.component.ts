import {Component, OnDestroy} from '@angular/core';
import {Subject} from 'rxjs';

@Component({
  template: ''
})

export abstract class BaseComponent implements OnDestroy {

  protected unsubscriber: Subject<boolean>;


  protected constructor() {
    this.unsubscriber = new Subject<boolean>();
  }

  public ngOnDestroy(): void {
    this.unsubscriber.next(true);
    this.unsubscriber.unsubscribe();
  }
}
